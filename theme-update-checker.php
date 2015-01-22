<?php
/**
 * Theme Update Checker Library 1.2
 * http://w-shadow.com/
 *
 * Copyright 2012 Janis Elsts
 * Licensed under the GNU GPL license.
 * http://www.gnu.org/licenses/gpl.html
 */

if ( !class_exists('ThemeUpdateChecker') ):

class ThemeUpdateChecker {
	public $theme = '';              //The theme associated with this update checker instance.
	public $metadataUrl = '';        //The URL of the theme's metadata file.
	public $enableAutomaticChecking = true; //Enable/disable automatic update checks.

	protected $optionName = '';      //Where to store update info.
	protected $automaticCheckDone = false;
	protected static $filterPrefix = 'tuc_request_update_';

	public function __construct($theme, $metadataUrl, $enableAutomaticChecking = true){
		$this->metadataUrl = $metadataUrl;
		$this->enableAutomaticChecking = $enableAutomaticChecking;
		$this->theme = $theme;
		$this->optionName = 'external_theme_updates-'.$this->theme;

		$this->installHooks();
	}

	public function installHooks(){
		//Check for updates when WordPress does. We can detect when that happens by tracking
		//updates to the "update_themes" transient, which only happen in wp_update_themes().
		if ( $this->enableAutomaticChecking ){
			add_filter('pre_set_site_transient_update_themes', array($this, 'onTransientUpdate'));
		}

		//Insert our update info into the update list maintained by WP.
		add_filter('site_transient_update_themes', array($this,'injectUpdate'));

		//Delete our update info when WP deletes its own.
		//This usually happens when a theme is installed, removed or upgraded.
		add_action('delete_site_transient_update_themes', array($this, 'deleteStoredData'));
	}

	public function requestUpdate($queryArgs = array()){
		//Query args to append to the URL. Themes can add their own by using a filter callback (see addQueryArgFilter()).
		$queryArgs['installed_version'] = $this->getInstalledVersion();
		$queryArgs = apply_filters(self::$filterPrefix.'query_args-'.$this->theme, $queryArgs);

		//Various options for the wp_remote_get() call. Themes can filter these, too.
		$options = array(
			'timeout' => 10, //seconds
		);
		$options = apply_filters(self::$filterPrefix.'options-'.$this->theme, $options);

		$url = $this->metadataUrl;
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url);
		}

		//Send the request.
		$result = wp_remote_get($url, $options);

		//Try to parse the response
		$themeUpdate = null;
		$code = wp_remote_retrieve_response_code($result);
		$body = wp_remote_retrieve_body($result);
		if ( ($code == 200) && !empty($body) ){
			$themeUpdate = ThemeUpdate::fromJson($body);
			//The update should be newer than the currently installed version.
			if ( ($themeUpdate != null) && version_compare($themeUpdate->version, $this->getInstalledVersion(), '<=') ){
				$themeUpdate = null;
			}
		}

		$themeUpdate = apply_filters(self::$filterPrefix.'result-'.$this->theme, $themeUpdate, $result);
		return $themeUpdate;
	}

	public function getInstalledVersion(){
		if ( function_exists('wp_get_theme') ) {
			$theme = wp_get_theme($this->theme);
			return $theme->get('Version');
		}

		foreach(get_themes() as $theme){
			if ( $theme['Stylesheet'] === $this->theme ){
				return $theme['Version'];
			}
		}
		return '';
	}

	public function checkForUpdates(){
		$state = get_option($this->optionName);
		if ( empty($state) ){
			$state = new StdClass;
			$state->lastCheck = 0;
			$state->checkedVersion = '';
			$state->update = null;
		}

		$state->lastCheck = time();
		$state->checkedVersion = $this->getInstalledVersion();
		update_option($this->optionName, $state); //Save before checking in case something goes wrong

		$state->update = $this->requestUpdate();
		update_option($this->optionName, $state);
	}

	public function onTransientUpdate($value){
		if ( !$this->automaticCheckDone ){
			$this->checkForUpdates();
			$this->automaticCheckDone = true;
		}
		return $value;
	}

	public function injectUpdate($updates){
		$state = get_option($this->optionName);

		//Is there an update to insert?
		if ( !empty($state) && isset($state->update) && !empty($state->update) ){
			$updates->response[$this->theme] = $state->update->toWpFormat();
		}

		return $updates;
	}

	public function deleteStoredData(){
		delete_option($this->optionName);
	}

	public function addQueryArgFilter($callback){
		add_filter(self::$filterPrefix.'query_args-'.$this->theme, $callback);
	}

	public function addHttpRequestArgFilter($callback){
		add_filter(self::$filterPrefix.'options-'.$this->theme, $callback);
	}

	public function addResultFilter($callback){
		add_filter(self::$filterPrefix.'result-'.$this->theme, $callback, 10, 2);
	}
}

endif;

if ( !class_exists('ThemeUpdate') ):

class ThemeUpdate {
	public $version;      //Version number.
	public $details_url;  //The URL where the user can learn more about this version.
	public $download_url; //The download URL for this version of the theme. Optional.

	public static function fromJson($json){
		$apiResponse = json_decode($json);
		if ( empty($apiResponse) || !is_object($apiResponse) ){
			return null;
		}

		//Very, very basic validation.
		$valid = isset($apiResponse->version) && !empty($apiResponse->version) && isset($apiResponse->details_url) && !empty($apiResponse->details_url);
		if ( !$valid ){
			return null;
		}

		$update = new self();
		foreach(get_object_vars($apiResponse) as $key => $value){
			$update->$key = $value;
		}

		return $update;
	}

	public function toWpFormat(){
		$update = array(
			'new_version' => $this->version,
			'url' => $this->details_url,
		);

		if ( !empty($this->download_url) ){
			$update['package'] = $this->download_url;
		}

		return $update;
	}
}

endif;

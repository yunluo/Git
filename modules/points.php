<?php
if ( !defined( 'POINTS_CORE_LIB' ) && defined( 'git_Ver' ) ) {
	define( 'POINTS_CORE_LIB', get_template_directory() . '/modules/lib' );
}

define( 'POINTS_DEFAULT_POINTS_LABEL', 'points' );
require_once ( POINTS_CORE_LIB . '/constants.php' );
require_once ( POINTS_CORE_LIB . '/class-points.php' );
require_once ( POINTS_CORE_LIB . '/class-points-database.php' );
require_once ( POINTS_CORE_LIB . '/class-points-shortcodes.php' );
require_once ( POINTS_CORE_LIB . '/class-points-admin.php' );
require_once ( POINTS_CORE_LIB . '/class-points-table.php' );
require_once ( POINTS_CORE_LIB . '/class-points-wordpress.php' );

class Points_Class {
	private static $notices = array();
	public static function init() {
		add_action( 'init', array( __CLASS__, 'wp_init' ) );
		add_action( 'load-themes.php', array( __CLASS__, 'activate' ) );
	}

	public static function wp_init() {
		Points_Admin::init();
	}

	/**
	 * activation work.
	 *
	 */
	public static function activate() {
		global $wpdb;

		$charset_collate = '';
		if ( ! empty( $wpdb->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		}
		if ( ! empty( $wpdb->collate ) ) {
			$charset_collate .= " COLLATE $wpdb->collate";
		}

		// create tables
		$points_users_table = Points_Database::points_get_table("users");
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$points_users_table'" ) != $points_users_table ) {
			$queries[] = "CREATE TABLE $points_users_table (
			point_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			user_id BIGINT(20) UNSIGNED NOT NULL,
			points   BIGINT(20) DEFAULT 0,
			datetime     datetime NOT NULL,
			description  varchar(5000),
			ref_id       BIGINT(20) DEFAULT null,
			ip           int(10) unsigned default NULL,
			ipv6         decimal(39,0) unsigned default NULL,
			data         longtext default NULL,
			status       varchar(10) NOT NULL DEFAULT '" . POINTS_STATUS_ACCEPTED . "',
			type         varchar(32) NULL,
			PRIMARY KEY   (point_id)
			) $charset_collate;";
		}
		if ( !empty( $queries ) ) {
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $queries );
		}
	}
}
Points_Class::init();
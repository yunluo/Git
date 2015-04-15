<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'git'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __( 'One', 'git' ),
		'two' => __( 'Two', 'git' ),
		'three' => __( 'Three', 'git' ),
		'four' => __( 'Four', 'git' ),
		'five' => __( 'Five', 'git' )
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'git' ),
		'two' => __( 'Pancake', 'git' ),
		'three' => __( 'Omelette', 'git' ),
		'four' => __( 'Crepe', 'git' ),
		'five' => __( 'Waffle', 'git' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( '常规设置', 'git' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( 'Input Text Mini', 'git' ),
		'desc' => __( 'A mini text input field.', 'git' ),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text'
	);
/*
	$options[] = array(
		'name' => __( '网站描述', 'git' ),
		'desc' => __( '请在这里输入您的网站描述，简单介绍一些您的网.', 'git' ),
		'id' => 'd_descrfiption',
		'std' => 'Default Value',
		'type' => 'text'
	);
*/

	$options[] = array(
		'name' => __( '网站描述', 'git' ),
		'desc' => __( '请在这里输入您的网站描述，简单介绍一些您的网站', 'git' ),
		'id' => 'd_description',
		'placeholder' => '请在这里输入您的网站描述，简单介绍一些您的网站',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '网站关键词', 'git' ),
		'desc' => __( '请在这里输入您的网站关键词', 'git' ),
		'id' => 'd_keywords',
		'placeholder' => '请在这里输入您的网站关键词',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '最新消息', 'git' ),
		'desc' => __( '最新消息显示在全站导航条下方，非常给力的推广位置', 'git' ),
		'id' => 'd_tui',
		'placeholder' => '这里的文字将显示在公告栏',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => __( '友情链接', 'git' ),
		'desc' => __( '最新消息显示在全站导航条下方，非常给力的推广位置', 'git' ),
		'id' => 'd_tui',
		'placeholder' => '这里的文字将显示在公告栏',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Textarea', 'git' ),
		'desc' => __( 'Textarea description.', 'git' ),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Input Select Small', 'git' ),
		'desc' => __( 'Small Select Box.', 'git' ),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array
	);

	$options[] = array(
		'name' => __( 'Input Select Wide', 'git' ),
		'desc' => __( 'A wider select box.', 'git' ),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array
	);

	if ( $options_categories ) {
		$options[] = array(
			'name' => __( 'Select a Category', 'git' ),
			'desc' => __( 'Passed an array of categories with cat_ID and cat_name', 'git' ),
			'id' => 'example_select_categories',
			'type' => 'select',
			'options' => $options_categories
		);
	}

	if ( $options_tags ) {
		$options[] = array(
			'name' => __( 'Select a Tag', 'options_check' ),
			'desc' => __( 'Passed an array of tags with term_id and term_name', 'options_check' ),
			'id' => 'example_select_tags',
			'type' => 'select',
			'options' => $options_tags
		);
	}

	$options[] = array(
		'name' => __( 'Select a Page', 'git' ),
		'desc' => __( 'Passed an pages with ID and post_title', 'git' ),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages
	);

	$options[] = array(
		'name' => __( 'Input Radio (one)', 'git' ),
		'desc' => __( 'Radio select with default options "one".', 'git' ),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array
	);

	$options[] = array(
		'name' => __( 'Example Info', 'git' ),
		'desc' => __( 'This is just some example information you can put in the panel.', 'git' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Input Checkbox', 'git' ),
		'desc' => __( 'Example checkbox, defaults to true.', 'git' ),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( '文章设置', 'git' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '禁用首行缩进', 'git' ),
		'desc' => __( '首航缩进可能会引起一些样式错位，所以禁用为好', 'git' ),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( '自定义', 'git' ),
		'desc' => __( 'Textarea description.', 'git' ),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( '社交设置', 'git' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Check to Show a Hidden Text Input', 'git' ),
		'desc' => __( 'Click here and see what happens.', 'git' ),
		'id' => 'example_showhidden',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Hidden Text Input', 'git' ),
		'desc' => __( 'This option is hidden unless activated by a checkbox click.', 'git' ),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Uploader Test', 'git' ),
		'desc' => __( 'This creates a full size uploader that previews the image.', 'git' ),
		'id' => 'example_uploader',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png'
		)
	);

	$options[] = array(
		'name' =>  __( 'Example Background', 'git' ),
		'desc' => __( 'Change the background CSS.', 'git' ),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background'
	);

	$options[] = array(
		'name' => __( 'Multicheck', 'git' ),
		'desc' => __( 'Multicheck description.', 'git' ),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array
	);

	$options[] = array(
		'name' => __( 'Colorpicker', 'git' ),
		'desc' => __( 'No color selected by default.', 'git' ),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color'
	);

	$options[] = array( 'name' => __( 'Typography', 'git' ),
		'desc' => __( 'Example typography.', 'git' ),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography'
	);

	$options[] = array(
		'name' => __( 'Custom Typography', 'git' ),
		'desc' => __( 'Custom typography options.', 'git' ),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options
	);
/*
	$options[] = array(
		'name' => __( 'Text Editor', 'git' ),
		'type' => 'heading'
	);
*/
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */
/*
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __( 'Default Text Editor', 'git' ),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'git' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);
*/	
	$options[] = array(
		'name' => __( '样式设置', 'git' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( '分类设置', 'git' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '使用CMS风格样式', 'git' ),
		'desc' => __( '开启主题CMS功能，关闭默认显示博客样式', 'git' ),
		'id' => 'd_cms_b',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( '分类一', 'git' ),
		'desc' => __( 'CMS风格第一分类', 'git' ),
		'id' => 'd_cat_1',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '分类二', 'git' ),
		'desc' => __( 'CMS风格第二分类', 'git' ),
		'id' => 'd_cat_2',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '分类三', 'git' ),
		'desc' => __( 'CMS风格第三分类', 'git' ),
		'id' => 'd_cat_3',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '分类四', 'git' ),
		'desc' => __( 'CMS风格第四分类', 'git' ),
		'id' => 'd_cat_4',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '分类五', 'git' ),
		'desc' => __( 'CMS风格第五分类', 'git' ),
		'id' => 'd_cat_5',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '分类六', 'git' ),
		'desc' => __( 'CMS风格第六分类', 'git' ),
		'id' => 'd_cat_6',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '分类七', 'git' ),
		'desc' => __( 'CMS风格第七分类', 'git' ),
		'id' => 'd_cat_7',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '分类八', 'git' ),
		'desc' => __( 'CMS风格第八分类', 'git' ),
		'id' => 'd_cat_8',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '首页隐藏分类', 'git' ),
		'desc' => __( '开启后，这些ID的分类将不在首页粗线', 'git' ),
		'id' => 'd_blockcat_b',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( '隐藏分类一', 'git' ),
		'desc' => __( '被隐藏的分类一', 'git' ),
		'id' => 'd_blockcat_1',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '隐藏分类二', 'git' ),
		'desc' => __( '被隐藏的分类二', 'git' ),
		'id' => 'd_blockcat_2',
		'class' => 'mini',
		'type' => 'text'
	);
		
	$options[] = array(
		'name' => __( '幻灯片设置', 'git' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '幻灯片【豪华版】', 'git' ),
		'desc' => __( '开启后，将开启一个包含缩略图的3D大屏幻灯片', 'git' ),
		'id' => 'd_sticky_b',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( '移动段禁止加载', 'git' ),
		'desc' => __( '开启后，幻灯片再移动段直接不加载', 'git' ),
		'id' => 'd_mobilesticky_b',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( '幻灯片数量', 'git' ),
		'desc' => __( '默认是四个,一般四个就够了', 'git' ),
		'id' => 'd_sticky_count',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '注意事项', 'git' ),
		'desc' => __( '<span class="tips">开启后请设置4篇以上的置顶文章,文章第一张图片为716*297</span>', 'git' ),
		'type' => 'info'
	);
	$options[] = array(
		'name' => __( '幻灯片【简约版】设置', 'git' ),
		'desc' => __( '<span class="tips">本幻灯片与上方幻灯片不能同时开启，否则DUANG！！！</span>', 'git' ),
		'id' => 'd_mobilesticky_b',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( '幻灯片一', 'git' ),
		'desc' => __( 'This creates a full size uploader that previews the image.', 'git' ),
		'id' => 'd_slick1_b',
		'type' => 'upload'
	);
	
	
	$options[] = array(
		'name' => __( '插件设置', 'git' ),
		'type' => 'heading'
	);
	
	//开始广告标签
	$options[] = array(
		'name' => __( '广告设置', 'git' ),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( '自定义设置', 'git' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '底部设置', 'git' ),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( '高级设置', 'git' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '新浪微博同步', 'git' ),
		'desc' => __( '开启后，请前往微博开放平台建立网站应用', 'git' ),
		'id' => 'd_sinasync_b',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => __( 'APPKEY', 'git' ),
		'desc' => __( '微博应用的appkey数字', 'git' ),
		'id' => 'd_wbapky_b',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '用户名', 'git' ),
		'desc' => __( '登录微博的用户名，最好是邮箱', 'git' ),
		'id' => 'd_wbuser_b',
		'class' => 'mini',
		'type' => 'text'
	);$options[] = array(
		'name' => __( '密码', 'git' ),
		'desc' => __( '登录微博的帐号密码', 'git' ),
		'id' => 'd_wbpasd_b',
		'class' => 'mini',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '注意事项', 'git' ),
		'desc' => __( '<a href="javascript:about();">如何使用微博同步？</a>&nbsp;&nbsp;&nbsp;<a target="_blank" class="button-primary" href="http://open.weibo.com/webmaster/add">微博开放平台</a>', 'git' ),
		'type' => 'info'
	);
	
	

	return $options;
}
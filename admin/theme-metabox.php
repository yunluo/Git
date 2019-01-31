<?php
error_reporting(E_ALL ^ E_NOTICE);//镇魔石，镇压一切魑魅魍魉！
if ( !class_exists('myCustomFields') ) {
 
    class myCustomFields {
        /**
        * @var  string  $prefix  自定义栏目前缀，一个完整的自定义栏目是需要前缀+name的，比如我的前缀是git_,name下面有baidu_submit，那么完整的自定义栏目就是git_baidu_submit.
        */
        var $prefix = 'git_';
        /**
        * @var  array  $postTypes  这是自定义面板的使用范围，这里一般就是在文章以及页面
        */
        var $postTypes = array( "page", "post", "product" );
        /**
        * @var  array  $customFields  开始组件自定义面板数组
        */
        var $customFields = array(
            
            array(
                "name"          => "wx_submit",
                "title"         => "推送到订阅用户微信",
                "description"   => "请慎重选择是否推送，优质的文章才值得推送哦，滥用此功能的可能会被禁用该功能哦~",
                "type"          => "checkbox",
                "scope"         =>   array( "post" ),
                "capability"    => "manage_options"
            ),
            array(
                "name"          => "thumb",
                "title"         => "自定义缩略图/主图",
                "description"   => "这里可以输入您的自定义缩略图链接、也是产品页面的产品主图",
                "type"          =>   "text",
                "scope"         =>   array(  "post", "product" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "product_cpjianjie",
                "title"         => "产品的简介",
                "description"   => "这里可以输入您的产品的简介，同时作为产品页面的摘要，字数不要多",
                "type"          =>   "text",
                "scope"         =>   array( "product" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "product_jiage",
                "title"         => "产品的价格",
                "description"   => "这里可以输入您的产品的销售价格，显示在产品页面和产品详情页",
                "type"          =>   "text",
                "scope"         =>   array( "product" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "product_fahuodi",
                "title"         => "产品的发货地址",
                "description"   => "这里可以输入您的产品的发货地址",
                "type"          =>   "text",
                "scope"         =>   array( "product" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "product_tblink",
                "title"         => "产品的购买链接",
                "description"   => "这里可以输入您的产品的购买外链，已做nofollow",
                "type"          =>   "text",
                "scope"         =>   array( "product" ),
                "capability"    => "edit_posts"
            ),
            /*没有这个功能，暂时留着而已
            array(
                "name"          => "singlecode",
                "title"         => "自定义jq",
                "description"   => "这里可以输入您的自定义jq代码",
                "type"          =>   "wysiwyg",
                "scope"         =>   array( "post", "page" ),
                "capability"    => "edit_posts"
            ),
            */
            array(
                "name"          => "zhuanzai_name",
                "title"         => "转载来源名字",
                "description"   => "这里可以输入文章转载名字，不填写的话，不显示转载标签",
                "type"          =>   "text",
                "scope"         =>   array( "post" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "zhuanzai_link",
                "title"         => "转载来源链接",
                "description"   => "这里可以输入您的转载来源链接",
                "type"          =>   "text",
                "scope"         =>   array( "post" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "download_name",
                "title"         => "单页下载文件名字",
                "description"   => "这里可以输入您的下载文件的名字",
                "type"          =>   "text",
                "scope"         =>   array( "post" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "download_size",
                "title"         => "单页下载文件大小",
                "description"   => "这里可以输入您的下载文件的大小，可以加上单位，比如：233KB或者233MB",
                "type"          =>   "text",
                "scope"         =>   array( "post" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "download_link",
                "title"         => "单页下载下载链接【新版】",
                "description"   => "按照链接,名字,备注的格式,注意中间是用英文逗号,换行可添加多个,举个栗子：<code>https://www.baidu.com,百度官网,中国最大的搜索引擎网站</code>",
                "type"          =>   "textarea",
                "scope"         =>   array( "post" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "demo",
                "title"         => "代码演示",
                "description"   => "请在这里输入您的演示代码",
                "type"          => "textarea",
                "scope"         =>   array( "post" ),
                "capability"    => "edit_pages"
            )
        );
        /**
        * PHP 5 Constructor
        */
        function __construct() {
            add_action( 'admin_menu', array( $this, 'createCustomFields' ) );
            add_action( 'save_post', array( $this, 'saveCustomFields' ), 1, 2 );
            // 下面这句可以关闭WordPress自带的自定义栏目，但是不推荐，需要的话可以开启
            //add_action( 'do_meta_boxes', array( $this, 'removeDefaultCustomFields' ), 10, 3 );
        }
        /**
        * 移除WordPress自带的自定义栏目
        
        function removeDefaultCustomFields( $type, $context, $post ) {
            foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
                foreach ( $this->postTypes as $postType ) {
                    remove_meta_box( 'postcustom', $postType, $context );
                }
            }
        }
        */
        /**
        * 创建一组你自己的自定义栏目
        */
        function createCustomFields() {
            if ( function_exists( 'add_meta_box' ) ) {
                foreach ( $this->postTypes as $postType ) {
                    add_meta_box( 'my-custom-fields', 'Git 主题文章发布选项', array( $this, 'displayCustomFields' ), $postType, 'normal', 'high' );
                }
            }
        }
        /**
        * 在文章发布页显示出来面板
        */
        function displayCustomFields() {
            global $post;
            ?>
            <div class="form-wrap">
                <?php
                wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
                foreach ( $this->customFields as $customField ) {
                    // Check scope
                    $scope = $customField[ 'scope' ];
                    $output = false;
                    foreach ( $scope as $scopeItem ) {
                        switch ( $scopeItem ) {
                            default: {
                                if ( $post->post_type == $scopeItem )
                                    $output = true;
                                break;
                            }
                        }
                        if ( $output ) break;
                    }
                    // 检查权限
                    if ( !current_user_can( $customField['capability'], $post->ID ) )
                        $output = false;
                    // 通过则输出
                    if ( $output ) { ?>
                        <div class="form-field form-required">
                            <?php
                            switch ( $customField[ 'type' ] ) {
                                case "checkbox": {
                                    // Checkbox 组件
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>  ';
                                    echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="1"';
                                    if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "1" )
                                        echo ' checked="checked"';
                                    echo '" style="width: auto;" />';
                                    break;
                                }
                                case "textarea":
                                case "wysiwyg": {
                                    // Text area
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                    echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="5">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
                                    // WYSIWYG
                                    if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
                                        <script type="text/javascript">
                                            jQuery( document ).ready( function() {
                                                jQuery( "<?php echo $this->prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
                                                if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
                                                    tinyMCE.execCommand( "mceAddControl", false, "<?php echo $this->prefix . $customField[ 'name' ]; ?>" );
                                                }
                                            });
                                        </script>
                                    <?php }
                                    break;
                                }
                                default: {
                                    // Plain text field
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                    echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
                                    break;
                                }
                            }
                            ?>
                            <?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
                        </div>
                    <?php
                    }
                } ?>
            </div>
            <?php
        }
        /**
        * 保存自定义栏目数据
        */
        function saveCustomFields( $post_id, $post ) {
            if ( !isset( $_POST[ 'my-custom-fields_wpnonce' ] ) || !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
                return;
            if ( !current_user_can( 'edit_post', $post_id ) )
                return;
            if ( ! in_array( $post->post_type, $this->postTypes ) )
                return;
            foreach ( $this->customFields as $customField ) {
                if ( current_user_can( $customField['capability'], $post_id ) ) {
                    if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
                        $value = $_POST[ $this->prefix . $customField['name'] ];
                        // Auto-paragraphs for any WYSIWYG
                        if ( $customField['type'] == "wysiwyg" ) $value = wpautop( $value );
                        update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $value );
                    } else {
                        delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
                    }
                }
            }
        }
 
    } // End Class
 
} // End if class exists statement
 
// Instantiate the class
if ( class_exists('myCustomFields') ) {
    $myCustomFields_var = new myCustomFields();
}
?>
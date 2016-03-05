<?php
if ( !class_exists('myCustomFields') ) {
 
    class myCustomFields {
        /**
        * @var  string  $prefix  The prefix for storing custom fields in the postmeta table
        */
        var $prefix = 'git_';
        /**
        * @var  array  $postTypes  An array of public custom post types, plus the standard "post" and "page" - add the custom types you want to include here
        */
        var $postTypes = array( "page", "post" );
        /**
        * @var  array  $customFields  Defines the custom fields available
        */
        var $customFields = array(
            array(
                "name"          => "baidu_submit",
                "title"         => "启用百度实时推送",
                "description"   => "选择之后可以实时推送至百度，不选择的话默认不推送",
                "type"          => "checkbox",
                "scope"         =>   array( "post", "page" ),
                "capability"    => "manage_options"
            ),
            array(
                "name"          => "remote_pic",
                "title"         => "启用远程图片本地化",
                "description"   => "选择之后文章中的远程图片可以实现本地化，不选择默认不保存",
                "type"          => "checkbox",
                "scope"         =>   array( "post", "page" ),
                "capability"    => "manage_options"
            ),
            array(
                "name"          => "weibo_sync",
                "title"         => "启用新浪微博同步",
                "description"   => "选择之后文章可以同步到新浪微博，不选择默认不同步【需配置好新浪微博同步】",
                "type"          => "checkbox",
                "scope"         =>   array( "post", "page" ),
                "capability"    => "manage_options"
            ),
            array(
                "name"          => "thumb",
                "title"         => "自定义缩略图",
                "description"   => "这里可以输入您的自定义缩略图链接",
                "type"          =>   "text",
                "scope"         =>   array( "post", "page" ),
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
                "name"          => "download_name",
                "title"         => "单页下载文件名字",
                "description"   => "这里可以输入您的下载文件的名字",
                "type"          =>   "text",
                "scope"         =>   array( "post", "page" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "download_size",
                "title"         => "单页下载文件大小",
                "description"   => "这里可以输入您的下载文件的大小，可以加上单位，比如：233KB或者233MB",
                "type"          =>   "text",
                "scope"         =>   array( "post", "page" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "download_link",
                "title"         => "单页下载下载链接",
                "description"   => "这里可以输入您的下载链接，这里使用的是A标签，如果多个的话就加入多个A标签",
                "type"          =>   "textarea",
                "scope"         =>   array( "post", "page" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "demo",
                "title"         => "代码演示",
                "description"   => "请在这里输入您的演示代码",
                "type"          => "textarea",
                "scope"         =>   array( "post", "page" ),
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
                                    echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
                                    if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
                                        echo ' checked="checked"';
                                    echo '" style="width: auto;" />';
                                    break;
                                }
                                case "textarea":
                                case "wysiwyg": {
                                    // Text area
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                    echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
                                    // WYSIWYG
                                    if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
                                        <script type="text/javascript">
                                            jQuery( document ).ready( function() {
                                                jQuery( "<?php echo $this->prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
                                                if ( typeof( tinyMCE ) == "object"  typeof( tinyMCE.execCommand ) == "function" ) {
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
        * Save the new Custom Fields values
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
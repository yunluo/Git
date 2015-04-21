<?php
include('wid-social.php');
include('wid-banner.php');
include('wid-readers.php');
include('wid-postlist.php');
include('wid-comment.php');
include('wid-tags.php');
include('wid-textbanner.php');
include('wid-subscribe.php');
include('wid-slides.php');
include('wid-rec.php');
include('wid-sclick.php');
add_action('widgets_init','unregister_d_widget');
function unregister_d_widget(){
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}

?>
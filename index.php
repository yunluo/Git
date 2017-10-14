<<<<<<< HEAD
<?php get_header(); ?>

<div class="content-wrap">
	<div class="content">
<?php
=======
<?php
get_header(); ?>
<?php
if (git_get_option('git_adindex_01')) printf('<div class="banner banner-navbar">' . git_get_option('git_adindex_01') . '</div>'); ?>
<div class="content-wrap">

	<div class="content">
	<?php
if (git_get_option('git_adindex_03')) printf('<div class="banner banner-contenttop">' . git_get_option('git_adindex_03') . '</div>');
>>>>>>> 8139b7357cac83572df28d58c3f7a41e55da56bb
if ($paged && $paged > 1) {
    printf('<header class="archive-header"><h1>最新发布 第' . $paged . '页</h1><div class="archive-header-info"><p>' . get_option('blogname') . get_option('blogdescription') . '</p></div></header>');
} else {
    if (git_get_option('git_sticky_b')) include 'modules/sticky.php';
<<<<<<< HEAD
    if (git_get_option('git_slick_b')) include 'modules/slick.php';
}
if(git_get_option('git_sticky_b') || git_get_option('git_slick_b')):
if (git_get_option('git_adindex_02')) echo'<div class="banner banner-sticky">' . git_get_option('git_adindex_02') . '</div>';
endif;
if (wp_is_mobile() && git_get_option('Mobiled_adindex_02')) echo '<div class="banner-sticky mobileads">' . git_get_option('Mobiled_adindex_02') . '</div>'; 
=======
    if (git_get_option('git_slick_b') && !G_is_mobile()) include 'modules/slick.php';
}
>>>>>>> 8139b7357cac83572df28d58c3f7a41e55da56bb
if (git_get_option('git_cms_b')) {
    include 'modules/cms.php';
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
<<<<<<< HEAD
    if (git_get_option('git_orderbygx')) {  $orderby = modified;  } else {  $orderby = date ; }
    $args = array(
        'ignore_sticky_posts' => 1,
        'paged' => $paged,
		'orderby' => $orderby 
    );
    query_posts($args);
	if (git_get_option('git_card_b')) {
	include 'modules/card.php';
	}else{
    include 'modules/excerpt.php';
	}
}
?>
	</div>
=======
    $args = array(
        'caller_get_posts' => 1,
        'paged' => $paged
    );
    query_posts($args);
    include 'modules/excerpt.php';
}
?>
	</div>

>>>>>>> 8139b7357cac83572df28d58c3f7a41e55da56bb
</div>
<?php
if (!G_is_mobile()) { ?>
<?php
    get_sidebar(); ?>
<?php
} ?>
<?php
get_footer(); ?>

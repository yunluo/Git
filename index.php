<?php get_header(); ?>

<div class="content-wrap">
	<div class="content">
<?php
if ($paged && $paged > 1) {
    printf('<header class="archive-header"><h1>最新发布 第' . $paged . '页</h1><div class="archive-header-info"><p>' . get_option('blogname') . get_option('blogdescription') . '</p></div></header>');
} else {
    if (git_get_option('git_sticky_b')) include 'modules/sticky.php';
    if (git_get_option('git_slick_b')) include 'modules/slick.php';
}
if(git_get_option('git_sticky_b') || git_get_option('git_slick_b')):
if (git_get_option('git_adindex_02')) echo'<div class="banner banner-sticky">' . git_get_option('git_adindex_02') . '</div>';
endif;
if (git_is_mobile() && git_get_option('Mobiled_adindex_02')) echo '<div class="banner-sticky mobileads">' . git_get_option('Mobiled_adindex_02') . '</div>'; 
if (git_get_option('git_cms_b')) {
    include 'modules/cms.php';
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if (git_get_option('git_orderbygx')) {  $orderby = 'modified';  } else {  $orderby = 'date'; }
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
</div>
<?php get_sidebar(); get_footer(); ?>
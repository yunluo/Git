<?php
get_header(); ?>
<?php
if (git_get_option('git_adindex_01')) printf('<div class="banner banner-navbar">' . git_get_option('git_adindex_01') . '</div>'); ?>
<div class="content-wrap">
	<div class="content">
	<?php
if (git_get_option('git_adindex_03')) printf('<div class="banner banner-contenttop">' . git_get_option('git_adindex_03') . '</div>');
if ($paged && $paged > 1) {
    printf('<header class="archive-header"><h1>最新发布 第' . $paged . '页</h1><div class="archive-header-info"><p>' . get_option('blogname') . get_option('blogdescription') . '</p></div></header>');
} else {
    if (git_get_option('git_sticky_b')) include 'modules/sticky.php';
    if (git_get_option('git_slick_b') && !G_is_mobile()) include 'modules/slick.php';
}

if (git_get_option('git_adindex_02')) printf('<div class="banner banner-sticky">' . git_get_option('git_adindex_02') . '</div>');
if (is_home()) {
    if(git_get_option('hot_list_check') || git_get_option('git_sticky_b')) {
        echo '<div><div class="left-ad" style="clear: both;background-color: #fff; width: 30%;float: left;margin-right:2%;"></div><div class="hot-posts">
			<h2 class="title">'.git_get_option('hot_list_title').'</h2>
			<ul>'.hot_posts_list($days = git_get_option('hot_list_date' )?git_get_option('hot_list_date' ):300 , $nums = git_get_option('hot_list_number' )?git_get_option('hot_list_number' ):5 ).'</ul>
		</div></div>';
    }
}
if (wp_is_mobile() && git_get_option('Mobiled_adindex_02')) printf('<div class="banner-sticky">' . git_get_option('Mobiled_adindex_02') . '</div>');
if (git_get_option('git_cms_b')) {
    include 'modules/cms.php';
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'caller_get_posts' => 1,
        'paged' => $paged
    );
    query_posts($args);
    include 'modules/excerpt.php';
}
?>
	</div>
</div>
<?php
if (!G_is_mobile()) { ?>
<?php
    get_sidebar(); ?>
<?php
} ?>
<?php
get_footer(); ?>
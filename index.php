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
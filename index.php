<?php
get_header(); ?>
<?php
if (dopt('d_adindex_01_b')) printf('<div class="banner banner-navbar">' . dopt('d_adindex_01') . '</div>'); ?>
<div class="content-wrap">

	<div class="content">
	<?php
if (dopt('d_adindex_03_b')) printf('<div class="banner banner-contenttop">' . dopt('d_adindex_03') . '</div>');
if ($paged && $paged > 1) {
    printf('<header class="archive-header"><h1>最新发布 第' . $paged . '页</h1><div class="archive-header-info"><p>' . get_option('blogname') . get_option('blogdescription') . '</p></div></header>');
} else {
    if (dopt('d_sticky_b')) include 'modules/sticky.php';
    if (dopt('d_slick_b') && !G_is_mobile()) include 'modules/slick.php';
}
if (dopt('d_cms_b')) {
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
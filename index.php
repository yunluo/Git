<?php get_header(); ?>
<?php if( dopt('d_adindex_01_b') ) printf('<div class="banner banner-navbar">'.dopt('d_adindex_01').'</div>'); ?>
<div class="content-wrap">
<?php if( dopt('d_blog_b') ){?>
	<div class="content">
	<?php
		if( dopt('d_adindex_03_b') ) printf('<div class="banner banner-contenttop">'.dopt('d_adindex_03').'</div>');

		if( $paged && $paged > 1 ){
			printf('<header class="archive-header"><h1>最新发布 第'.$paged.'页</h1><div class="archive-header-info"><p>'.get_option('blogname').get_option('blogdescription').'</p></div></header>');
		}else{
			if( dopt('d_sticky_b') ) include 'modules/sticky.php';
		}

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
		    'caller_get_posts' => 1,
		    'paged' => $paged
		);
		query_posts($args);
		include 'modules/excerpt.php';
	?>
	</div>
	<?php } ?>

<?php if( dopt('d_cms_b') ){?>
	<div class="content">
	<?php
		if( dopt('d_adindex_03_b') ) printf('<div class="banner banner-contenttop">'.dopt('d_adindex_03').'</div>');

		if( dopt('d_sticky_b') ) include 'modules/sticky.php';

		include 'modules/cms.php';
	?>
	</div>
	<?php } ?>
</div>
<?php get_sidebar(); get_footer(); ?>
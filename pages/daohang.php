<?php
/*
*	template name: 网址导航
*	description: template for Git theme
*/
get_header();
?>
<div class="pagewrapper clearfix">
		<header class="pageheader clearfix">
			<h1 class="pull-left">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			<div class="pull-right"><!-- 百度分享 -->
	<?php deel_share() ?>
			</div>
		</header>
		<?php while (have_posts()) : the_post(); ?>
			<div class="article-content">
				<?php the_content(); ?>
				<style type="text/css">.apollo_1 .sitename{padding-left:25px;}</style>
				<?php echo get_link_items(); ?>
		</div>
<?php comments_template('', true); endwhile;  ?>
</div>
<?php get_footer(); ?>
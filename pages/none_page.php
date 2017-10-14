<?php
/*
	template name: 空页面
<<<<<<< HEAD
	description: template for Git theme
=======
	description: template for G theme
>>>>>>> 8139b7357cac83572df28d58c3f7a41e55da56bb
*/
get_header();
?>

<div class="pagewrapper clearfix">
<<<<<<< HEAD
=======


>>>>>>> 8139b7357cac83572df28d58c3f7a41e55da56bb
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
			</div>
		<?php comments_template('', true); endwhile;  ?>

</div>

<?php get_footer(); ?>
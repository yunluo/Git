<?php
/*
	template name: 空页面
	description: template for Git theme
*/
get_header();
?>
<div class="pagewrapper clearfix">
		<?php while (have_posts()) : the_post(); ?>
			<div class="article-content">
				<?php the_content(); ?>
			</div>
		<?php comments_template('', true); endwhile;  ?>
</div>
<?php get_footer(); ?>
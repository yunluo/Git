<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<header class="archive-header">
			<h1>标签：<?php echo single_tag_title(); ?></h1>
		</header>
		<?php include( 'modules/excerpt.php' ); ?>
	</div>
</div>
<?php if(!G_is_mobile() ){?>
<?php get_sidebar();?>
<?php }?>
<?php get_footer(); ?>
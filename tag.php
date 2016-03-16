<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<header class="archive-header">
			<h1>标签：<?php echo single_tag_title(); ?></h1>
		</header>
		<?php if (git_get_option('git_card_b'))
		{
		include 'modules/card.php';
		}else{
		include 'modules/excerpt.php';
		}?>
	</div>
</div>
<?php get_sidebar(); get_footer(); ?>
<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<?php if ( !have_posts() ) : ?>
			<header class="archive-header">
				<h1>没有找到有关【<?php echo htmlspecialchars($s); ?>】的内容</h1>
				<p class="muted">给您推荐以下内容：</p>
			</header>
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
				    'showposts' => 4,
				    'ignore_sticky_posts' => 1,
				    'paged' => $paged
				);
				query_posts($args);
			?>
			<?php if (git_get_option('git_card_b'))
		{
		include 'modules/card.php';
		}else{
		include 'modules/excerpt.php';
		}?>
		<?php else: ?>
			<header class="archive-header">
				<h1>有关【<?php echo htmlspecialchars($s); ?>】的内容</h1>
			</header>
			<?php if (git_get_option('git_card_b'))
		{
		include 'modules/card.php';
		}else{
		include 'modules/excerpt.php';
		}?>
		<?php endif; ?>
	</div>
</div>
<?php get_sidebar(); get_footer(); ?>
<?php

get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<header class="archive-header">
			<?php
if (category_description()) echo '<div class="archive-header-banner">' . category_description() . '</div>'; ?>
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
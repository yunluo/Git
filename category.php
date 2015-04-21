<?php

get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<header class="archive-header">
			<?php
if (category_description()) echo '<div class="archive-header-banner">' . category_description() . '</div>'; ?>
		</header>
		<?php
include ('modules/excerpt.php'); ?>
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
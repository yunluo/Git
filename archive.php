<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<header class="archive-header"> 
			<h1><?php 
				if(is_day()) echo the_time('Y年m月j日');
				elseif(is_month()) echo the_time('Y年m月');
				elseif(is_year()) echo the_time('Y年'); 
			?>的内容</h1>
		</header>
		<?php include( 'modules/excerpt.php' ); ?>
	</div>
</div>
<?php get_sidebar(); get_footer(); ?>
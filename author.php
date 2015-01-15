<?php get_header(); 
	global $wp_query;
	$curauth = $wp_query->get_queried_object();
?>
<div class="content-wrap">
	<div class="content">
		<header class="archive-header"> 
			<h1><?php echo $curauth->display_name.'的文章' ?></h1>
			<?php if ( $curauth->description ) echo '<div class="archive-header-info">'.$curauth->description.'</div>'; ?>
		</header>
		
		<?php include( 'modules/excerpt.php' ); ?>
	</div>
</div>
<?php get_sidebar(); get_footer(); ?>
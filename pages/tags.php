<?php
/*
 	template name: 标签云
 	description: template for Git theme
*/
get_header();
?>
<div class="pagewrapper clearfix">
<style type="text/css">.tag-clouds a{width:44%;opacity:.70;filter:alpha(opacity=80);color:#fff;display:inline-block;margin:0 5px 5px 0;padding:2px 6px;line-height:180%;font-weight:bold;}.tag-clouds a:hover{opacity:1;filter:alpha(opacity=100)}</style>
	<aside class="pagesidebar">
		<ul class="pagesider-menu">
			<?php
echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'pagemenu', 'echo' => false))));?>
		</ul>
	</aside>
	<div class="pagecontent">
		<header class="pageheader clearfix">
			<h1 class="pull-left">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			<div class="pull-right">
				<?php deel_share() ?>
			</div>
		</header>
		<ul class="tag-clouds">
			<?php $tags_list = get_tags('orderby=count&order=DESC');
			if ($tags_list) {
				foreach($tags_list as $tag) {
					echo '<li><a class="btn btn-primary sitecolor_' . mt_rand(1, 14) . '" href="'.get_tag_link($tag).'">'. $tag->name .'</a><strong>x '. $tag->count .'</strong><br>';
					echo '</li>';
				}
			}
			?>
		</ul>
	</div>
</div>
<?php get_footer(); ?>
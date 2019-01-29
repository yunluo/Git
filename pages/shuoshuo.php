<?php
/*

Template Name: 说说页面

*/
get_header(); ?>
<div class="pagewrapper clearfix">
		<header class="pageheader clearfix">
			<h1 class="pull-left">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			<div class="pull-right"><!-- 百度分享 -->
	<?php deel_share() ?>
			</div>
		</header>
<div class="shuoshuo">
 <ul class="archives-monthlisting">
<?php $limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('post_type=shuoshuo&post_status=publish&showposts=' . $limit=10 . '&paged=' . $paged);
while (have_posts()) : the_post(); ?>
 <li><span class="tt"><?php
        the_time('Y年n月j日G:i'); ?></span>
 <div id="shuo-<?php the_ID(); ?>" class="shuoshuo-content"><?php
        the_content(); ?><br/><div class="shuoshuo-meta"><span class="shuoshuo-sjsj" style="float:left"><?php
        the_time('Y年n月j日G:i'); ?></span ><span >— <i class="fa fa-user"></i> <?php
        the_author() ?></span></div></div>
        <span class="zhutou"><?php echo get_avatar(get_the_author_meta('email'),64); ?></span>
        </li>
<?php endwhile;wp_reset_query(); ?>
 </ul>
</div>
</div>
<?php
deel_paging(); ?>
<?php get_footer(); ?>
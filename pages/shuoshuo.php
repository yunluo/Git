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
 <?php
query_posts("post_type=shuoshuo&post_status=publish&posts_per_page=-1");
if (have_posts()):
    while (have_posts()):
        the_post(); ?>
 <li><span class="tt"><?php
        the_time('Y年n月j日G:H'); ?></span>
 <div class="shuoshuo-content"><?php
        the_content(); ?><br/><div class="shuoshuo-meta"><span >— <i class="fa fa-user"></i> <?php
        the_author() ?></span></div></div>
        <span class="zhutou"><?php echo get_avatar(get_the_author_email(),64); ?></span>
        <?php
    endwhile;
endif; ?></li>
 </ul>
</div>
</div>
<?php get_footer(); ?>
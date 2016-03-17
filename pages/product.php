<?php
/*

Template Name: 产品页面

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
<div id="goodslist" class="goodlist" role="main">

<?php
    query_posts('post_type=product&post_status=publish'); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
	        <div class="col span_1_of_4" role="main">
			<div class="shop-item">
				<a href="<?php
        the_permalink(); ?>" alt="<?php
        the_title(); ?>" title="<?php
        the_title(); ?>" class="fancyimg home-blog-entry-thumb">
					<div class="thumb-img focus">
					<?php
            echo '<img class="thumb" title="'.get_the_title().'" src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=375&w=375&q=90&zc=1&ct=1" width="375px" height="375px" alt="' . get_the_title() . '" />';
         ?>			
			</div>
				</a>
				<h3><a href="<?php
        the_permalink(); ?>" alt="<?php
        the_title(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        the_title(); ?></a>
				</h3>
				<p><?php
		$excerpt = $post->post_excerpt;
		if (empty($excerpt)) {
            echo deel_strimwidth(strip_tags(apply_filters('the_content', strip_shortcodes($post->post_content))) , 0, git_get_option('git_excerpt_length') ? git_get_option('git_excerpt_length') : 100 , '……');
        } else {
            echo deel_strimwidth(strip_tags(apply_filters('the_excerpt', strip_shortcodes($post->post_excerpt))) , 0, git_get_option('git_excerpt_length') ? git_get_option('git_excerpt_length') : 100 , '……'); 
        } ?></p>
				<div class="pricebtn"><i class="fa fa-user"></i> <?php
        echo get_the_author() ?><a class="buy" href="<?php
        the_permalink(); ?>"><i class="fa fa-shopping-cart"></i> 立刻购买</a></div>
			</div>
		</div>
		<?php
endwhile;
wp_reset_query(); ?>
</div>

<?php
deel_paging(); ?>

<?php get_footer(); ?>
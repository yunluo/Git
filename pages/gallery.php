<?php
/*

Template Name: 相册页面

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
<div id="cardslist" class="cardlist" role="main">
<?php $limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('post_type=gallery&post_status=publish&showposts=' . $limit=20 . '&paged=' . $paged);
if (have_posts()) : while (have_posts()) : the_post(); ?>
	        <div class="col span_1_of_4" role="main">
			<div class="shop-item">
				<a href="<?php
        the_permalink(); ?>" alt="<?php
        the_title(); ?>" title="<?php
        the_title(); ?>" class="fancyimg home-blog-entry-thumb">
					<div class="thumb-img focus">
					<?php
        if (git_get_option('git_cdnurl_b') ) {
            echo '<img class="thumb" style="width:275px;height:250px" src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/275/h/250/q/75" alt="' . get_the_title() . '" />';
        } else {
            echo '<img class="thumb" style="width:275px;height:250px" src="' . get_template_directory_uri() . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=250&w=275&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?>
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
        the_permalink(); ?>"><i class="fa fa-eye"></i> 立刻查看</a></div>
			</div>
		</div>
		<?php endwhile;endif; ?>
</div>
<?php deel_paging(); ?>
<?php get_footer(); ?>
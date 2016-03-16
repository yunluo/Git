<?php
if (is_home()) { ?>
    <?php
    if (git_get_option('hot_list_check') || git_get_option('git_sticky_b')) { ?>
		<div><div class="left-ad" style="clear: both;background-card color: #fff; width: 30%;float: left;margin-right:2%;"></div><div class="hot-posts">
			<h2 class="title"><?php echo git_get_option('hot_list_title') ?></h2>
			<ul><?php hot_posts_list(); ?></ul>
		</div></div>
	<?php
    } ?>
<?php
} ?>
<div class="pagewrapper">
<div id="goodslist" class="goodlist" role="main">

            <?php
    while (have_posts()):
        the_post(); ?>
	        <div class="card col span_1_of_4" role="main">
			<div class="shop-item">
				<a href="<?php
        the_permalink(); ?>" alt="<?php
        the_title(); ?>" title="<?php
        the_title(); ?>" class="fancyimg home-blog-entry-thumb">
					<div class="thumb-img focus"><?php
            echo '<img class="thumb" title="'.get_the_title().'" src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=250&w=375&q=90&zc=1&ct=1" width="375px" height="250px" alt="' . get_the_title() . '" />';
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
        the_permalink(); ?>"><i class="fa fa-eye"></i> 立刻查看</a></div>
			</div>
		</div>
		<?php
endwhile;
wp_reset_query(); ?>
</div>
</div>
<?php
deel_paging(); ?>
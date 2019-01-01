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
<div class="pagewrapper" style="padding-top:.1px">
<div id="cardslist" class="cardlist" role="main">
            <?php
    while (have_posts()):
        the_post(); ?>
	        <div class="card col span_1_of_4" role="main">
			<div class="card-item">
					<div class="thumb-img focus">
					<div class="metacat"><?php
    if (!is_category()) {
        $category = get_the_category();
        if ($category[0]) {
            echo '<a class="metacat" href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';
        }
    }; ?>
</div><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>"><?php
        if(git_get_option('git_lazyload') ){$src = 'data-original';}else{$src = 'src';}
        if (git_get_option('git_qncdn_b') ) {
            if(git_get_option('git_cdnurl_style') ){
                $githumb5 = '!githumb5.jpg';
            }else{
                $githumb5 = '?imageView2/1/w/253/h/169/q/75';
            }
            echo '<img class="thumb" style="width:253px;height:169px" '.$src.'="';
            echo post_thumbnail_src();
            echo ''.$githumb5.'" alt="' . get_the_title() . '" />';
        } else {
            echo '<img class="thumb" style="width:253px;height:169px" '.$src.'="' . GIT_URL . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=169&w=253&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?></a>
			</div>
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
				<div class="cardpricebtn"><i class="fa fa-calendar"></i> <?php
        the_time('m-d'); ?><a class="cardbuy" href="<?php
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
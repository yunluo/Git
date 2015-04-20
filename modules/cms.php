<?php

if (git_get_option('git_adindex_02')) printf('<div class="banner banner-sticky">' . git_get_option('git_adindex_02') . '</div>'); ?>
<?php
if (is_home() && git_get_option('hot_list_check')) { ?>
		<div><div class="left-ad" style="clear: both;background-color: #fff; width: 30%;float: left;margin-right:2%;"></div><div class="hot-posts">
			<h2 class="title"><?php
    echo git_get_option('hot_list_title') ?></h2>
			<ul><?php
    hot_posts_list($days = git_get_option('hot_list_date' )?git_get_option('hot_list_date' ):30 , $nums = git_get_option('hot_list_number' )?git_get_option('hot_list_number' ):5 ); ?></ul>
		</div></div>
		<?php
} ?>
<style type="text/css">.widget-title{background:#FFFFFF;} .title-h2{ height: 45px; border-bottom: 1px solid #90BBA8; margin: 5px 20px;}</style>
<!-- 最新文章开始 -->
<div class="relates"><h2 class="title"><small>最新文章</small><span class="more" style="float:right;"><a style="left: 0px;" href="/archives" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>

<ul style="padding: 5px 0px 15px 20px;">
<?php 
get_archives('postbypost', 10); ?>
<?php
while (have_posts()):
    the_post(); ?>
<li><i class="fa fa-minus"></i><a href="<?php
    the_permalink() ?>"><?php
    the_title(); ?></a>[<?php
    the_time(‘m - d - y’); ?>]</li>
<?php
endwhile; ?>
</ul>
</div>
<!-- 最新文章结束 -->
<?php
if (git_get_option('git_cat_1')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_1')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_1')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
		<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_1')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
<?php
if (git_get_option('git_cat_2')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_2')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_2')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
			<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_2')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
<?php
if (git_get_option('git_cat_3')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_3')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_3')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
		<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_3')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
<?php
if (git_get_option('git_cat_4')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_4')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_4')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
		<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_4')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
<?php
if (git_get_option('git_cat_5')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_5')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_5')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
		<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_5')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
<?php
if (git_get_option('git_cat_6')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_6')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_6')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
		<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_6')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
<?php
if (git_get_option('git_cat_7')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_7')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_7')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
		<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_7')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
<?php
if (git_get_option('git_cat_8')) { ?>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php
    echo get_cat_name(git_get_option('git_cat_8')); ?></small><span class="more" style="float:right;"><a style="left: 0px;" href="<?php
    echo get_category_link(git_get_option('git_cat_8')); ?>" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>
		<div class="related_posts">
			<?php
    query_posts(array(
        'showposts' => 4,
        'cat' => git_get_option('git_cat_8')
    )); ?>
            <?php
    while (have_posts()):
        the_post(); ?>
				<ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if (git_get_option('git_cdnurl_b')) {
            echo '<img src="';
            echo post_thumbnail_src();
            echo '?imageView2/1/w/185/h/110/q/85" alt="' . get_the_title() . '" />';
        } else {
            echo '<img src="' . get_bloginfo("template_url") . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul>
            <?php
    endwhile; ?>
		</div></div>
<?php
} ?>
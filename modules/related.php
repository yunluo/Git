<div class="related_posts"><ul class="related_img">
<?php
$post_num = 4;
$exclude_id = $post->ID;
$posttags = get_the_tags();
$i = 0;
if ($posttags) {
    $tags = '';
    foreach ($posttags as $tag) $tags.= $tag->term_id . ',';
    $args = array(
        'post_status' => 'publish',
        'tag__in' => explode(',', $tags) ,
        'post__not_in' => explode(',', $exclude_id) ,
        'ignore_sticky_posts' => 1,
        'orderby' => 'comment_date',
        'posts_per_page' => $post_num
    );
    query_posts($args);
    while (have_posts()) {
        the_post(); ?>
		<li class="related_box"  >
		<a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if(git_get_option('git_lazyload') ){$src = 'data-original';}else{$src = 'src';}
        if (git_get_option('git_qncdn_b') ) {
            if(git_get_option('git_cdnurl_style') ){
                $githumb3 = '!githumb3.jpg';
            }else{
                $githumb3 = '?imageView2/1/w/185/h/110/q/75';
            }
            echo '<img class="thumb" style="width:185px;height:110px" '.$src.'="';
            echo post_thumbnail_src();
            echo ''.$githumb3.'" alt="' . get_the_title() . '" />';
        } else {
            echo '<img class="thumb" style="width:185px;height:110px" '.$src.'="' . GIT_URL . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a>
		</li>
	<?php
        $exclude_id.= ',' . $post->ID;
        $i++;
    }
    wp_reset_query();
}
if ($i < $post_num) {
    $cats = '';
    foreach (get_the_category() as $cat) $cats.= $cat->cat_ID . ',';
    $args = array(
        'category__in' => explode(',', $cats) ,
        'post__not_in' => explode(',', $exclude_id) ,
        'ignore_sticky_posts' => 1,
        'orderby' => 'comment_date',
        'posts_per_page' => $post_num - $i
    );
    query_posts($args);
    while (have_posts()) {
        the_post(); ?>

	<li class="related_box"  >
		<a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        if(git_get_option('git_lazyload') ){$src = 'data-original';}else{$src = 'src';}
        if (git_get_option('git_qncdn_b') ) {
            if(git_get_option('git_cdnurl_style') ){
                $githumb3 = '!githumb3.jpg';
            }else{
                $githumb3 = '?imageView2/1/w/185/h/110/q/75';
            }
            echo '<img class="thumb" style="width:185px;height:110px" '.$src.'="';
            echo post_thumbnail_src();
            echo ''.$githumb3.'" alt="' . get_the_title() . '" />';
        } else {
            echo '<img class="thumb" style="width:185px;height:110px" '.$src.'="' . GIT_URL . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a>
		</li>
	<?php
        $i++;
    }
    wp_reset_query();
}
if ($i == 0) echo '<div class=\"r_title\">没有相关文章!</div>'; ?>
</ul>

<div class="relates">
<ul>
<?php
$exclude_id = $post->ID;
$posttags = get_the_tags();
$i = 0;
$limit = git_get_option('git_related_count') ? git_get_option('git_related_count') : 8;
if ($posttags) {
    $tags = '';
    foreach ($posttags as $tag) $tags.= $tag->name . ',';
    $args = array(
        'post_status' => 'publish',
        'tag_slug__in' => explode(',', $tags) ,
        'post__not_in' => explode(',', $exclude_id) ,
        'ignore_sticky_posts' => 1,
        'offset' => 4,
        'orderby' => 'comment_date',
        'posts_per_page' => $limit
    );
    query_posts($args);
    while (have_posts()) {
        the_post();
        echo '<li><i class="fa fa-minus"></i><a href="' . get_permalink() . '">', get_the_title() , '</a></li>';
        $exclude_id.= ',' . $post->ID;
        $i++;
    };
    wp_reset_query();
}
if ($i < $limit) {
    $cats = '';
    foreach (get_the_category() as $cat) $cats.= $cat->cat_ID . ',';
    $args = array(
        'category__in' => explode(',', $cats) ,
        'post__not_in' => explode(',', $exclude_id) ,
        'ignore_sticky_posts' => 1,
        'orderby' => 'comment_date',
        'posts_per_page' => $limit - $i
    );
    query_posts($args);
    while (have_posts()) {
        the_post();
        echo '<li><i class="fa fa-minus"></i><a target="_blank" href="' . get_permalink() . '">', get_the_title() , '</a></li>';
        $i++;
    };
    wp_reset_query();
}
if ($i == 0) {
    echo '<li>暂无相关文章！</li>';
} ?>

</ul></div></div>
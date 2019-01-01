<?php
if (git_get_option('git_mobilesticky_b')) echo '<style type="text/css">@media screen and (max-width:1100px){ #wowslider-container1{display:none !important ;}}</style>'; ?>
<div id="wowslider-container1">
	<div class="ws_images"><ul>
<?php
$sticky = get_option('sticky_posts');
rsort($sticky);
query_posts(array(
    'post__in' => $sticky,
    'ignore_sticky_posts' => 1,
    'showposts' => git_get_option('git_sticky_count') ? git_get_option('git_sticky_count') : 4
));
while (have_posts()):
    the_post();
    if(git_get_option('git_lazyload') ){$src = 'data-original';}else{$src = 'src';}
    echo '<li><a target="_blank" href="' . get_permalink() . '" title="' . get_the_title() . '">';
    echo '<img '.$src.'="';
    echo post_thumbnail_src();
    echo '" title="' . get_the_title() . '" alt="' . get_the_title() . '" /></a></li>';
endwhile;
wp_reset_query();
?>
	</ul>
</div>

<div class="ws_thumbs">
<div>
<?php
if(git_get_option('git_lazyload') ){$src = 'data-original';}else{$src = 'src';}
if (git_get_option('git_qncdn_b')) {
    $sticky = get_option('sticky_posts');
    rsort($sticky);
    query_posts(array(
        'post__in' => $sticky,
        'ignore_sticky_posts' => 1,
        'showposts' => git_get_option('git_sticky_count') ? git_get_option('git_sticky_count') : 4
    ));
    while (have_posts()):
        the_post();
            if(git_get_option('git_cdnurl_style') ){
                $githumb2 = '!githumb2.jpg';
            }else{
                $githumb2 = '?imageView2/1/w/120/h/62/q/75';
            }
        echo '<a target="_blank" href="#" title="' . get_the_title() . '">';
        echo '<img '.$src.'="';
        echo post_thumbnail_src();
        echo ''.$githumb2.'" alt="' . get_the_title() . '" /></a>';
    endwhile;
    wp_reset_query();
} else {
    $sticky = get_option('sticky_posts');
    rsort($sticky);
    query_posts(array(
        'post__in' => $sticky,
        'ignore_sticky_posts' => 1,
        'showposts' => git_get_option('git_sticky_count') ? git_get_option('git_sticky_count') : 4
    ));
    while (have_posts()):
        the_post();
        echo '<a target="_blank" href="#" title="' . get_the_title() . '">';
        echo '<img '.$src.'="' . GIT_URL . '/timthumb.php?src=';
        echo post_thumbnail_src();
        echo '&h=62&w=120&q=90&zc=1&ct=1" /></a>';
    endwhile;
    wp_reset_query();
}
?>
</div>
</div><div class="ws_shadow"></div>
	</div><?php wp_enqueue_script('slider', GIT_URL . '/assets/js/slider.js', array('jquery')); ?>
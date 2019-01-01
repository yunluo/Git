<?php
if (is_home()) { ?>
    <?php
    if (git_get_option('hot_list_check') || git_get_option('git_sticky_b')) { ?>
		<div><div class="left-ad" style="clear: both;background-color: #fff; width: 30%;float: left;margin-right:2%;"></div><div class="hot-posts">
			<h2 class="title"><?php echo git_get_option('hot_list_title') ?></h2>
			<ul><?php hot_posts_list(); ?></ul>
		</div></div>
	<?php
    } ?>
<?php
} ?>
<style type="text/css">.widget-title{background:#FFFFFF;}.title-h2{ padding-top: 5px;height: 45px; border-bottom: 1px solid #90BBA8; margin: 5px 20px;}</style>

<!-- 最新文章开始 -->
<div class="relates"><h2 class="title"><small>最新文章</small></h2>
<ul style="padding: 5px 0px 15px 20px;">
    <?php
    global $post;
    $args = array(
  'numberposts' => 10,
  'post_status'    => 'publish',
  'category'       => git_get_option('git_blockcat')
);
$result = get_posts( $args );
foreach ($result as $post) :
    setup_postdata($post);
    $postid = $post->ID;
    $title = $post->post_title;
?>
    <li><i class="fa fa-minus"></i><a class="lastitle" href="<?php
    echo get_permalink($postid); ?>" title="<?php
    echo $title ?>"><?php
    echo $title ?></a></li>
    <?php
    endforeach;
    wp_reset_postdata();?>
</ul>
</div>
<!-- 最新文章结束 -->
<?php
if(git_get_option('git_cdnurl_style') ){
                $githumb3 = '!githumb3.jpg';
            }else{
                $githumb3 = '?imageView2/1/w/185/h/110/q/75';
            }
    $cats = explode(',', git_get_option('git_cat_id') );
    foreach($cats as $the_cat){
        $posts = get_posts(array(
            'category' => $the_cat,
            'numberposts' => git_get_option('git_cat_num')
        ));
        if(!empty($posts)):
            echo '<div class="widget-title"><h2 class="title-h2"><small>'.get_cat_name($the_cat).'</small><span class="more" style="float:right;"><a style="left: 0px;" href="'.get_category_link($the_cat).'" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2><div class="related_posts">';
                    foreach($posts as $post):?>
        <ul class="related_img" style="display:inline" ><li class="related_box" ><a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" ><?php
        if(git_get_option('git_lazyload') ){$src = 'data-original';}else{$src = 'src';}
       if (git_get_option('git_qncdn_b') ) {
            echo '<img style="width:185px;height:110px" '.$src.'="';
            echo post_thumbnail_src();
            echo ''.$githumb3.'" alt="' . get_the_title() . '" />';
        } else {
            echo '<img style="width:185px;height:110px" '.$src.'="' . GIT_URL . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=110&w=185&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?><br><span class="r_title"><?php
        the_title(); ?></span></a></li></ul><?php
                    endforeach;
                echo '</div></div>';
        endif;
    }
?>
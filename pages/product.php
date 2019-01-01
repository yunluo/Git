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
<div id="cardslist" class="cardlist" role="main">
<?php $limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('post_type=product&post_status=publish&showposts=' . $limit=20 . '&paged=' . $paged);
if (have_posts()) : while (have_posts()) : the_post(); ?>
	        <div class="col span_1_of_4" role="main">
			<div class="card-item">
				<a href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" class="fancyimg home-blog-entry-thumb">
					<div class="thumb-img focus">
					<?php
		if(git_get_option('git_lazyload') ){$src = 'data-original';}else{$src = 'src';}
        if (git_get_option('git_qncdn_b') ) {
        	if(git_get_option('git_cdnurl_style') ){
                $githumb6 = '!githumb6.jpg';
            }else{
                $githumb6 = '?imageView2/1/w/275/h/275/q/75';
            }
            echo '<img class="thumb" style="width:275px;height:275px" '.$src.'="';
            echo post_thumbnail_src();
            echo ''.$githumb6.'" alt="' . get_the_title() . '" />';
        } else {
            echo '<img class="thumb" style="width:275px;height:275px" '.$src.'="' . GIT_URL . '/timthumb.php?src=';
            echo post_thumbnail_src();
            echo '&h=275&w=275&q=90&zc=1&ct=1" alt="' . get_the_title() . '" />';
        } ?>
			</div>
				</a>
				<h3><a href="<?php
        the_permalink(); ?>" alt="<?php
        the_title(); ?>" title="<?php
        the_title(); ?>" target="_blank"><?php
        the_title(); ?></a>
				</h3>
				<p><?php echo get_post_meta($post->ID, 'git_product_cpjianjie', true); ?></p>
				<div class="cardpricebtn"><i class="fa fa-jpy"></i> <?php
        echo get_post_meta($post->ID, 'git_product_jiage', true); ?><a class="cardbuy" href="<?php
        the_permalink(); ?>"><i class="fa fa-shopping-cart"></i> 立刻购买</a></div>
			</div>
		</div>
<?php endwhile;endif; ?>
</div>
<?php deel_paging(); ?>
<?php get_footer(); ?>
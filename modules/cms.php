		<?php if( dopt('d_adindex_02_b') ) printf('<div class="banner banner-sticky">'.dopt('d_adindex_02').'</div>'); ?>
<?php if(is_home()&& dopt('hot_list_check') ){ ?>
		<div><div class="left-ad" style="clear: both;background-color: #fff; width: 30%;float: left;margin-right:2%;"></div><div class="hot-posts">
			<h2 class="title"><?php echo dopt('hot_list_title') ?></h2>
			<ul><?php hot_posts_list($days=dopt('hot_list_date'), $nums=dopt('hot_list_number')); ?></ul>
		</div></div>
		<?php } ?>
<style type="text/css">.ithumb{margin-left:10%;}.first-posts h3{margin: 0;font-weight: normal;font-size: 16px;line-height: 24px;overflow : visible;}
.first-posts p{margin: 0;color: #999;line-height: 24px;}.first-posts .post-thumbnail{float: left;border: 1px solid #eee;}
.first-posts .post-thumbnail:hover{border: 1px solid #ccc;}.summary{margin:0;padding:0;outline:0;border:0;background:transparent;vertical-align:baseline;font-size:100%;}.widget-title{width:50%;background:#FFFFFF;float:left;}.widget-box { overflow: hidden; background-color: #FFF; border-top: 1px solid #F2F2F2; margin-bottom: 10px;} .widget-ul { padding: 7px 0px 7px 10px; overflow: hidden; } .title-h2{position: relative; height: 45px; border-bottom: 1px solid #90BBA8; margin: 5px 20px;}
@media screen and (max-width:600px){ .widget-title{width:100%;background:#FFFFFF;float:left;}}</style>
<div class="relates"><h2 class="title"><small>最新文章</small><span class="more" style="float:right;"><a style="left: 0px;" href="/archives" title="阅读更多" target="_blank"><small>阅读更多</small></a></span></h2>

    <?php query_posts('showposts=15'); ?>
    <ul>
        <?php while (have_posts()) : the_post(); ?>
        <li ><span class="muted"></span><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><span id="date">[<?php the_time('Y-m-d');?>]</span></li>
        <?php endwhile;?>
     </ul></div>
<!-- 最新文章结束 -->
<div class="widget-box">
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_1') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_1') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_2') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_2') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
</div>
<div class="widget-box">
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_3') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_3') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_4') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_4') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
</div>
<div class="widget-box">
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_5') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_5') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_6') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_6') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
</div>
<div class="widget-box">
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_7') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_7') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
        <div class="widget-title">
			<h2 class="title-h2"><small><?php echo get_cat_name(dopt('d_cat_8') );?></small></h2>
			<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_8') ) ); ?>
            <?php while (have_posts()) : the_post(); ?>
				<ul class="widget-ul"><li class="widget-li"><i class="fa fa-star-o"></i>  <a href=<?php the_permalink() ?> target=“_blank” title=“<?php the_title(); ?>” ><?php the_title(); ?></a></li></ul>
            <?php endwhile; ?>
		</div>
</div>
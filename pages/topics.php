<?php
/*
 	template name: 专题页面
 	description: template for Git theme
*/
get_header();
?>
<div class="pagewrapper clearfix zhuanti">
<style type="text/css">.zhuanti>header{margin-bottom:30px;background-color:#fff;box-shadow:0 2px 0 rgba(41,67,73,.01),0 1px 0 rgba(0,0,0,.05)}.zhuanti .topic-list{margin-left:4%;max-width:100%}.topic-card{position:relative;display:block;overflow:hidden}.topic-card .banner{display:block;width:100%;min-height:10pc}.topic-card .mask{position:absolute;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.5);transition:all .5s}.topic-card:hover .mask{background-color:rgba(0,0,0,.2)}.topic-card.large .mask h4{font-size:20px;font-size:1.25rem;line-height:1.1}.topic-card .mask h4{display:-webkit-box;overflow:hidden;margin:25px 0 0;padding:0 20px;color:#fff;text-overflow:ellipsis;font-size:1pc;font-size:1rem;line-height:1.5;-webkit-line-clamp:2;-webkit-box-orient:vertical}.topic-card .mask footer{position:absolute;bottom:0;left:0;box-sizing:border-box;padding:20px;width:100%;text-align:right}.topic-card .mask footer .btn,.topic-card .mask footer em{font-weight:300;font-size:9pt;font-size:.75rem}.sbtn{display:inline-block;padding:9pt 24px;border:1px solid #fff;border-radius:75pt;background-color:transparent;color:#fff;text-align:center;text-decoration:none;font-size:14px;font-size:.875rem;cursor:pointer}.topic-card .mask footer em{float:left;margin-top:10px;color:#fff;font-style:normal}.load-more-wrapper{margin:0 45px 40px 0;width:100%}.load-more{display:block;width:100%;height:70px;border:1px solid #dbe2e8;background-color:#fff;box-shadow:0 1px 2px rgba(46,61,73,.08);color:#403e3e;text-align:center;font-size:17pt;line-height:70px;cursor:pointer}@media (min-width:769px){.zhuanti>header{padding-top:50px}.zhuanti .topic-list{display:flex;flex-wrap:wrap;flex-direction:row}.zhuanti .topic-list .topic-card{margin:0 30px 40px 0;width:260px;height:140px}}@media (max-width:600px){.zhuanti .topic-list{margin-left:0}}</style>
<header>
<h1 class="pull-center">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			</header>
<div class="topic-list">
<?php $tags_list = get_tags('orderby=count&order=DESC&number=24');
if ($tags_list) {
	foreach($tags_list as $tag) {
		$term_id = $tag->term_id;
		$term_meta = get_option( "ludou_taxonomy_$term_id" );
		$tax_image = $term_meta['tax_image'] ? $term_meta['tax_image'] : '';
		$tax_title = $term_meta['tax_title'] ? $term_meta['tax_title'] : '';
		echo '<a href="'.get_tag_link($tag).'" class="topic-card"><img class="banner" src="'.$tax_image.'" lazy="loaded"> <div class="mask"><h4>'.$tax_title.'</h4> <footer><em>'. $tag->count .' 个[<strong>'. $tag->name .'</strong>]类专题</em> <button class="sbtn">查看</button> </footer></div></a>';
	}
}
?>
<div class="load-more-wrapper loaded" style=""><a href="<?php echo get_permalink(git_page_id('tags'));?>" class="load-more">查看更多</a></div>
 </div>
</div>
<?php get_footer(); ?>
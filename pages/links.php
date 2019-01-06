<?php
/*
	template name: 友情链接
	description: template for Git theme
*/
get_header();
?>
<style type="text/css">dl,ol,ul{list-style-type:none}.cate-content .borderr-main-4{background-color:#f5f5f5;border-bottom:1px solid #eee}.cate-content .borderr-main-4:hover{-webkit-box-shadow:0 15px 10px -10px rgba(110,110,110,.5),0 1px 4px rgba(110,110,110,.3),0 0 60px rgba(110,110,110,.1) inset;-moz-box-shadow:0 15px 10px -10px rgba(110,110,110,.5),0 1px 4px rgba(110,110,110,.3),0 0 40px rgba(110,110,110,.1) inset;box-shadow:0 15px 10px -10px rgba(110,110,110,.5),0 1px 4px rgba(110,110,110,.3),0 0 40px rgba(110,110,110,.1) inset}.cate-content strong{text-transform:uppercase}.cate-content img{position:relative;top:-2px;width:16px;height:16px}.cate-content .link-1{border-radius:4px 4px 0 0}.cate-content .link-2{border-bottom:1px solid #eee}.link-name{text-overflow:ellipsis;word-wrap:break-word;white-space:nowrap;word-break:break-all}.cate-content a{text-decoration:none}.cate-content a:hover{color:#1098F7}.link_notes{max-width:88%;max-height:20px;overflow:hidden;text-overflow:ellipsis}.text-overflow{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.en-text-overflow{word-wrap:break-word;word-break:break-all}.clearfix:after{display:block;height:0;clear:both;visibility:hidden}.col-md-12,.col-md-4{min-height:1px;position:relative;padding-left:15px;padding-right:15px;box-sizing:border-box;-webkit-transition:all .3s ease-in;-moz-transition:all .3s ease-in;-o-transition:all .3s ease-in;transition:all .3s ease-in}@media(max-width:700px){.col-md-4{float:left}.col-md-4{width:50%}}@media(max-width:500px){.col-md-4{width:100%}}@media(min-width:800px){.col-md-4{float:left}.col-md-12{width:100%}.col-md-4{width:33.33333333333333%}}.strong{font-weight:700}.mgr-10{margin:10px}.mt-15{margin-top:15px}.mb-15{margin-bottom:15px}.pd-0{padding:0}.pd-10{padding:10px}.pd-15{padding:15px}.pd-20{padding:20px}.pt-10{padding-top:10px}.pb-10{padding-bottom:10px}.pb-20{padding-bottom:20px}.of-hide{overflow:hidden}.color-primary{color:#394a58}.color-fff{color:#fff}.color-aaa{color:#aaa}.bg-lvs1{background-color:#2ecc71}.bg-lvs2{background-color:#27ae60}.bg-lvs3{background-color:#3498db}.bg-lvs4{background-color:#2980b9}.bg-lvs5{background-color:#9b59b6}.bg-lvs6{background-color:#8e44ad}.bg-lvs7{background-color:#34495e}.bg-lvs8{background-color:#2c3e50}.bg-lvs9{background-color:#f1c40f}.bg-lvs10{background-color:#f39c12}.bg-lvs11{background-color:#e67e22}.bg-lvs12{background-color:#d35400}.bg-lvs13{background-color:#e74c3c}.bg-lvs14{background-color:#c0392b}.bg-primary{background-color:#39f}.tra{-webkit-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-o-transition:all .3s ease-out;transition:all .3s ease-out}.borderr-main-4{border-radius:4px}</style>
<div class="pagewrapper clearfix">
	<aside class="pagesidebar">
		<ul class="pagesider-menu">
			<?php
echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'pagemenu', 'echo' => false))));?>
		</ul>
	</aside>
	<div class="pagecontent">
		<header class="pageheader clearfix">
			<h1 class="pull-left">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			<div class="pull-right">
				<?php deel_share() ?>
			</div>
		</header>
		<?php while (have_posts()) : the_post(); ?>
			<article class="article-content">
				<?php the_content(); ?>
			</article>

			<div class="mgr-10 of-hide cate-content">
			<?php
$bookmarks = get_bookmarks(array('category' => git_get_option('git_linkpage_cat')?git_get_option('git_linkpage_cat'):''));

if ( !empty($bookmarks) ){
    echo '<ul class="clearfix">';
foreach ($bookmarks as $bookmark) {
	if ($bookmark->link_image ) {
		$ico = $bookmark->link_image ;
	}else{
		$ico = 'https://f.ydr.me/' . $bookmark->link_url . '';
	}
        echo '<li class="col-md-4 mt-15 mb-15 pd-10">
<div class="pd-0 h-100 borderr-main-4 tra">
	<div class="clearfix pd-20 bg-lvs'.mt_rand(1,13).' link-1 rate_' . $bookmark->link_id . '">
		<div class="col-md-12 pd-0 of-hide">
			<strong><a title="' . $bookmark->link_description . '" href="' . $bookmark->link_url . '" target="_blank" class="w-100 f14 color-fff link-name">'. $bookmark->link_name .'</a></strong>
				<p class="f12 color-fff text-overflow">' . $bookmark->link_url . '</p>
		</div>
	</div>
	<div class="pd-20 pt-10 pb-10 color-primary clearfix link-2">
	<p class="color-aaa text-overflow">' . $bookmark->link_description . '</p>
	</div>
	<div class="pd-20 pt-10 pb-20 color-primary clearfix link-3 ">
		<span class="pull-left color-aaa link_notes"><i class="fa fa-pencil-square-o" ></i>  ' . $bookmark->link_notes . '</span>
			<span class="pull-right"><a title="' . $bookmark->link_description . '" href="' . $bookmark->link_url . '" target="_blank" class="f14 color-aaa"><img class="favicon avatar" src="' . $ico . '"></a></span>
		</div>
<div class="clearfix"></div>
</div>
</li>';
    }
    echo '</ul>';
}
?>
</div>
			<?php comments_template('', true); ?>
		<?php endwhile;  ?>
	</div>
</div>
<?php get_footer(); ?>
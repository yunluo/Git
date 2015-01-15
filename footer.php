</section>
<footer style="border-top: 20px solid ;background-image: url('<?php bloginfo('template_url'); ?>/img/footbg.jpg'); background-repeat: repeat;" class="footer">
    <div class="footer-inner">
        <div class="fooert copyright" align="center">
         <a href="<?php site_url(); ?>" title="<?php bloginfo(‘name’); ?>"><?php bloginfo(‘name’); ?>     </a> 版权所有，保留一切权利 · <a href="<?php site_url(); ?>/sitemap.xml" title="站点地图">站点地图</a>   ·   基于WordPress构建   © 2014-2015  ·   托管于 <a rel="nofollow" target="_blank" href="http://googlo.me/go/hengtian">衡天主机</a> & <a rel="nofollow" target="_blank" href="http://googlo.me/go/qiniu">七牛云存储</a>  <span><?php if( dopt('d_track_b') ) echo dopt('d_track'); ?></span>
        </div>
    </div>
</footer>
<?php if( dopt('d_footcode_b') ) echo dopt('d_footcode'); ?>
<?php if( dopt('d_fancybox_b') ){?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fancybox.js"></script><?php } ?>
<script type="text/javascript">$(document).ready(function() {$(".fancybox").fancybox();$("#showdiv").fancybox({'centerOnScroll':true});});
jQuery(document).ready(
function(jQuery){
jQuery('.collapseButton').click(function(){
jQuery(this).parent().parent().find('.xContent').slideToggle('slow');
});
});</script>

<?php
wp_footer();
global $dHasShare;
if($dHasShare == true){
	echo'<script>with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>';
}
?>
</body>
</html>
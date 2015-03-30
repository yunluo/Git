</section>
<?php if( dopt('d_superfoot_b')&& !G_is_mobile() ){?>
<div id="footbar" style="border-top: 2px solid #8E44AD;"><ul>
<li><p class="first"><?php echo dopt('d_foottitle1'); ?></p><?php echo dopt('d_footconent1'); ?></li>
<li><p class="second"><?php echo dopt('d_foottitle2'); ?></p><?php echo dopt('d_footconent2'); ?></li>
<li><p class="third"><?php echo dopt('d_foottitle3'); ?></p><?php echo dopt('d_footconent3'); ?></li>
<li><p class="fourth"><?php echo dopt('d_foottitle4'); ?></p><?php echo dopt('d_footconent4'); ?></li>
</ul>
</div>
<?php } ?>
<footer style="border-top: 1px solid ;background-image: url('<?php bloginfo('template_url'); ?>/img/footbg.jpg'); background-repeat: repeat;" class="footer">
<div class="footer-inner"><div class="fooert copyright" align="center"><?php if( dopt('d_footcode_b') ) echo dopt('d_footcode'); ?> &nbsp;Designed by <a target="_blank" href="http://yusi123.com">欲思</a> & <a target="_blank" href="http://googlo.me">云落</a> <span class="trackcode pull-right"><?php if( dopt('d_track_b') ) echo dopt('d_track'); ?></span></div></div></footer>
<?php if( dopt('d_copydialog_b')&& is_singular() ) echo '<script type="text/javascript">document.body.oncopy=function(){alert("复制成功！若要转载请务必保留原文链接，申明来源，谢谢合作！");}</script>';?>
<?php if( dopt('d_fancybox_b') ) echo '<script type="text/javascript" src="'.get_bloginfo("template_url").'/js/fancybox.js"></script>';?>
<?php if( dopt('d_snow_b') ) {?><script type="text/javascript">(function(a){a.fn.snow=function(d){var g=a('<div id="snowbox" />').css({position:"absolute","z-index":"9999",top:"-50px"}).html("&#10052;"),f=a(document).height(),b=a(document).width(),e={minSize:10,maxSize:20,newOn:1000,flakeColor:"#FFF"},d=a.extend({},e,d);var c=setInterval(function(){var l=Math.random()*b-100,j=0.5+Math.random(),h=d.minSize+Math.random()*d.maxSize,i=f-200,k=l-500+Math.random()*500,m=f*10+Math.random()*5000;g.clone().appendTo("body").css({left:l,opacity:j,"font-size":h,color:d.flakeColor}).animate({top:i,left:k,opacity:0.2},m,"linear",function(){a(this).remove()})},d.newOn)}})(jQuery);$(function(){$.fn.snow({minSize:5,maxSize:50,newOn:300})});
</script><?php } ?>
<?php if( dopt('d_copy_b')&& is_singular() ) echo '<script type="text/Javascript">document.oncontextmenu=function(e){return false;};document.onselectstart=function(e){return false;};</script><style>body{ -moz-user-select:none;}</style><SCRIPT LANGUAGE=javascript>if (top.location != self.location)top.location=self.location;</SCRIPT><noscript><iframe src=*.html></iframe></noscript>';?>
<?php if( dopt('d_slick_b')&&!G_is_mobile() ) echo '<script type="text/javascript" src="'.get_bloginfo("template_url").'/js/slick.js"></script>';?>
<?php if( dopt('d_footercode_b') ) echo dopt('d_footercode'); ?>
</script>
<?php
wp_footer();
global $dHasShare;
if($dHasShare == true){
	echo'<script>with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="'.get_bloginfo("template_url").'/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>';
}
?>
</body>
</html>
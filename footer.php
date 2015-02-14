</section>
<?php if( dopt('d_superfoot_b') ){?>
<div id="footbar" style="border-top: 2px solid #8E44AD;"><ul>
<li><p class="first"><?php echo dopt('d_foottitle1'); ?></p><?php echo dopt('d_footconent1'); ?></li>
<li><p class="second"><?php echo dopt('d_foottitle2'); ?></p><?php echo dopt('d_footconent2'); ?></li>
<li><p class="third"><?php echo dopt('d_foottitle3'); ?></p><?php echo dopt('d_footconent3'); ?></li>
<li><p class="fourth"><?php echo dopt('d_foottitle4'); ?></p><?php echo dopt('d_footconent4'); ?></li>
</ul>
</div>
<?php } ?>
<footer style="border-top: 1px solid ;background-image: url('<?php bloginfo('template_url'); ?>/img/footbg.jpg'); background-repeat: repeat;" class="footer">
    <div class="footer-inner">
        <div class="fooert copyright" align="center">
         <?php if( dopt('d_footcode_b') ) echo dopt('d_footcode'); ?><span class="trackcode pull-right"><?php if( dopt('d_track_b') ) echo dopt('d_track'); ?></span>
        </div>
    </div>
</footer>
<?php if( dopt('d_fancybox_b') ){?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fancybox.js"></script><?php } ?>
<?php if( dopt('d_snow_b') ){?><script type="text/javascript">(function($){$.fn.snow=function(options){var $flake=$('<div id="snowbox" />').css({'position':'absolute','z-index':'9999','top':'-50px'}).html('&#10052;'),documentHeight=$(document).height(),documentWidth=$(document).width(),defaults={minSize:10,maxSize:20,newOn:1000,flakeColor:"#AFDAEF"},options=$.extend({},defaults,options);var interval=setInterval(function(){var startPositionLeft=Math.random()*documentWidth-100,startOpacity=0.5+Math.random(),sizeFlake=options.minSize+Math.random()*options.maxSize,endPositionTop=documentHeight-200,endPositionLeft=startPositionLeft-500+Math.random()*500,durationFall=documentHeight*10+Math.random()*5000;$flake.clone().appendTo('body').css({left:startPositionLeft,opacity:startOpacity,'font-size':sizeFlake,color:options.flakeColor}).animate({top:endPositionTop,left:endPositionLeft,opacity:0.2},durationFall,'linear',function(){$(this).remove()})},options.newOn)}})(jQuery);$(function(){$.fn.snow({minSize:5,maxSize:50,newOn:280})});</script><?php } ?>
<?php if( dopt('d_copy_b') ){?>
<script type="text/Javascript">document.oncontextmenu=function(e){return false;};document.onselectstart=function(e){return false;};</script><style>body{ -moz-user-select:none;}</style><SCRIPT LANGUAGE=javascript>if (top.location != self.location)top.location=self.location;</SCRIPT><noscript><iframe src=*.html></iframe></noscript>
<?php } ?>
<?php
wp_footer();
global $dHasShare;
if($dHasShare == true){
	echo'<script>with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>';
}
?>
</body>
</html>
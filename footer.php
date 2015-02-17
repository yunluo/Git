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
<div class="footer-inner"><div class="fooert copyright" align="center"><?php if( dopt('d_footcode_b') ) echo dopt('d_footcode'); ?><span class="trackcode pull-right"><?php if( dopt('d_track_b') ) echo dopt('d_track'); ?></span></div></div></footer>
<?php if( dopt('d_copydialog_b')&& is_single() ) echo '<script type="text/javascript">function warning(){if(navigator.userAgent.indexOf("MSIE")>0){art.dialog.alert("复制成功！若亲要转载请务必保留原文链接，申明来源，谢谢合作！")}else{alert("复制成功！若亲要转载请务必保留原文链接，申明来源，谢谢合作！")}}document.body.oncopy=function(){warning()};</script>';?>
<?php if( dopt('d_fancybox_b')&& is_single() ){?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fancybox.js"></script><?php } ?>
<?php if( dopt('d_snow_b') ){?><script type="text/javascript">function snowFall(a){a=a||{};this.maxFlake=a.maxFlake||300;this.flakeSize=a.flakeSize||10;this.fallSpeed=a.fallSpeed||1}requestAnimationFrame=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame||window.oRequestAnimationFrame||function(a){setTimeout(a,1000/60)};cancelAnimationFrame=window.cancelAnimationFrame||window.mozCancelAnimationFrame||window.webkitCancelAnimationFrame||window.msCancelAnimationFrame||window.oCancelAnimationFrame;snowFall.prototype.start=function(){snowCanvas.apply(this);createFlakes.apply(this);drawSnow.apply(this)};function snowCanvas(){var a=document.createElement("canvas");a.id="snowfall";a.width=window.innerWidth;a.height=document.body.clientHeight;a.setAttribute("style","position:absolute; top: 0; left: 0; z-index: 1; pointer-events: none;");document.getElementsByTagName("body")[0].appendChild(a);this.canvas=a;this.ctx=a.getContext("2d");window.onresize=function(){a.width=window.innerWidth}}function flakeMove(a,b,d,c){this.x=Math.floor(Math.random()*a);this.y=Math.floor(Math.random()*b);this.size=Math.random()*d+2;this.maxSize=d;this.speed=Math.random()*1+c;this.fallSpeed=c;this.velY=this.speed;this.velX=0;this.stepSize=Math.random()/30;this.step=0}flakeMove.prototype.update=function(){var a=this.x,b=this.y;this.velX*=0.98;if(this.velY<=this.speed){this.velY=this.speed}this.velX+=Math.cos(this.step+=0.05)*this.stepSize;this.y+=this.velY;this.x+=this.velX;if(this.x>=canvas.width||this.x<=0||this.y>=canvas.height||this.y<=0){this.reset(canvas.width,canvas.height)}};flakeMove.prototype.reset=function(b,a){this.x=Math.floor(Math.random()*b);this.y=0;this.size=Math.random()*this.maxSize+2;this.speed=Math.random()*1+this.fallSpeed;this.velY=this.speed;this.velX=0};flakeMove.prototype.render=function(a){var b=a.createRadialGradient(this.x,this.y,0,this.x,this.y,this.size);b.addColorStop(0,"rgba(231,76,60, 0.9)");b.addColorStop(0.5,"rgba(231,76,60, 0.6)");b.addColorStop(1,"rgba(231,76,60, 0)");a.save();a.fillStyle=b;a.beginPath();a.arc(this.x,this.y,this.size,0,Math.PI*2);a.fill();a.restore()};function createFlakes(){var a=this.maxFlake,c=this.flakes=[],b=this.canvas;for(var d=0;d<a;d++){c.push(new flakeMove(b.width,b.height,this.flakeSize,this.fallSpeed))}}function drawSnow(){var a=this.maxFlake,b=this.flakes;ctx=this.ctx,canvas=this.canvas,that=this;ctx.clearRect(0,0,canvas.width,canvas.height);for(var c=0;c<a;c++){b[c].update();b[c].render(ctx)}this.loop=requestAnimationFrame(function(){drawSnow.apply(that)})}var snow=new snowFall({maxFlake:60});snow.start();
</script><?php } ?>
<?php if( dopt('d_copy_b')&& is_single() ){?>
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
<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<header class="archive-header">
<<<<<<< HEAD
			<?php if(tag_description()){;?>
			<div class="archive-header-banner"><?php echo tag_description(); ?></div>
			<?php }else{;?>
=======
>>>>>>> 8139b7357cac83572df28d58c3f7a41e55da56bb
			<h1>标签：<?php echo single_tag_title(); ?></h1>
			<?php };?>
		</header>
		<?php if (git_get_option('git_card_b'))
		{
		include 'modules/card.php';
		}else{
		include 'modules/excerpt.php';
		}?>
	</div>
</div>
<?php if(!G_is_mobile() ){?>
<?php get_sidebar();?>
<?php }?>
<?php get_footer(); ?>

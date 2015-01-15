<li>
    <h2>最新文章</h2>
    <?php query_posts('showposts=10'); ?>
    <ul>
        <?php while (have_posts()) : the_post(); ?>
        <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
        <?php endwhile;?>
     </ul>
</li>

<!-- start: cmsl -->
    <div class=“first-art”>
        	<?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_1') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:left;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
		<?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_1'), 'offset' => 1 ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cmsl -->

	<!-- start: cms2 -->
    <div class=“first-art”>
        <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_2') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:right;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
        <?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_2'), 'offset' => 1 ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cms2 -->

	<!-- start: cms3 -->
    <div class=“first-art”>
        <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_3') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:left;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
        <?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_3'), 'offset' => 1 ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cms3 -->

	<!-- start: cms4 -->
    <div class=“first-art”>
        <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_4') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:right;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
        <?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_4'), 'offset' => 1 ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cms4 -->

	<!-- start: cms5 -->
    <div class=“first-art”>
       <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_5') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:left;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
        <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_5') ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cms5 -->

	<!-- start: cms6 -->
    <div class=“first-art”>
        <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_6') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:right;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
        <?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_6'), 'offset' => 1 ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cms6 -->

	<!-- start: cms7 -->
    <div class=“first-art”>
        <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_7') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:left;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
        <?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_7'), 'offset' => 1 ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cms7 -->

	<!-- start: cms8 -->
    <div class=“first-art”>
        <?php query_posts( array( 'showposts' => 1, 'cat' => dopt('d_cat_8') ) ); ?>
        <?php while (have_posts()) : the_post(); ?>
        <a href=“<?php the_permalink() ?>”  target=“_blank”>
            <div class=“pic-con sprite-wp” style=“float:right;width:90px”>
            </div>
        </a>
            <div class=“first-content”>
                <h3>
                <a title=“<?php the_title(); ?>” href=“<?php the_permalink() ?>” target=“_blank”>
                <?php the_title(); ?>
                </a>
                </h3>
                <p><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 150,“…”); ?>…</p>
            </div>
       <?php endwhile; ?>
    </div>
    <div>
        <?php query_posts( array( 'showposts' => 6, 'cat' => dopt('d_cat_8'), 'offset' => 1 ) ); ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
                <span id=“date”>[<?php the_time(‘m-d’); ?>]</span>
                <a href=“<?php the_permalink() ?>” target=“_blank” title=“<?php the_title(); ?>”>
                <?php the_title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
	<!-- end: cms8 -->


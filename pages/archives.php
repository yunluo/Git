<?php
/*
    template name: 文章存档
    description: template for yusi123.com Yusi theme 
*/
get_header(); 
?>
<div class="pagewrapper clearfix">
    <aside class="pagesidebar">
        <ul class="pagesider-menu">
            <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'pagemenu', 'echo' => false)) )); ?>
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

            <article class="archives">
                <?php
                $previous_year = $year = 0;
                $previous_month = $month = 0;
                $ul_open = false;
                 
                $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
                
                foreach($myposts as $post) :
                    setup_postdata($post);
                 
                    $year = mysql2date('Y', $post->post_date);
                    $month = mysql2date('n', $post->post_date);
                    $day = mysql2date('j', $post->post_date);
                    
                    if($year != $previous_year || $month != $previous_month) :
                        if($ul_open == true) : 
                            echo '</ul></div>';
                        endif;
                 
                        echo '<div class="item"><h3>'; echo the_time('F Y'); echo '</h3>';
                        echo '<ul class="archives-list">';
                        $ul_open = true;
                 
                    endif;
                 
                    $previous_year = $year; $previous_month = $month;
                ?>
                    <li>
                        <time><?php the_time('j'); ?>日</time>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <span class="muted"><?php comments_number('', '1评论', '%评论'); ?></span>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
            </article>

        <?php endwhile;  ?>
    </div>
</div>
<?php get_footer(); ?>
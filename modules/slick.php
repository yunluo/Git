<div class="slick">
<?php
for ($x = 1; $x <= 6; $x++) {
    if (git_get_option('git_slick' . $x . 'img_b')) {
        echo '<div><a href="' . git_get_option('git_slick' . $x . 'url_b') . '"><img width="855px" height="300px" src="' . git_get_option('git_slick' . $x . 'img_b') . '" alt="' . git_get_option('git_slick' . $x . 'title_b') . '"><span>' . git_get_option('git_slick' . $x . 'title_b') . '</span></a></div>';
    }
}
?>
</div>
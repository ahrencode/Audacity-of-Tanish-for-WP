<?php get_header(); ?>

<div id='indexpage'>
    <?php include("entry.php"); ?>
</div>

<div class="navigation">
    <?php
        previous_posts_link(
            "<span class='capsule' style='float: right;'>" .
            "Newer Entries &raquo;" .
            "</span>");
    ?>
    <?php
        next_posts_link("<span class='capsule'>&laquo; Older Entries</span>");
    ?>
</div>

<?php get_footer(); ?>


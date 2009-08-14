<?php get_header(); ?>

<div id='single'>

    <?php include('entry.php'); ?>

    <?php
        wp_link_pages(
                array
                (
                    'before' => '<div id="subpagelinks"><span>Pages:</span> ',
                    'after' => '</div>',
                    'next_or_number' => 'number'
                )
        );
    ?>

</div>

<?php comments_template(); ?>

<?php get_footer(); ?>


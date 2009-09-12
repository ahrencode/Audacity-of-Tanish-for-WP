<?php get_header(); ?>

<div id='indexpage'>
    <?php include("entry.php"); ?>
</div>

<div class="navigation">
    <?php previous_posts_link("<span style='float: right;'>Newer Entries &raquo;</span>"); ?>
    <?php next_posts_link("<span>&laquo; Older Entries</span>"); ?>
</div>

<?php global $options; if( $options['expandfirst'] == 1 ) : ?>

    <script language='JavaScript'>

        showIndexPost.call($('#indexpage > .post:first .posttitlebar'));

    </script>

<?php endif; ?>

<?php get_footer(); ?>



</div> <!-- container -->
</div> <!-- bgtilediv -->

<?php get_sidebar(); ?>

<?php global $options; if( $options['showcredits'] == 1 ) : ?>
    <div id='creditsbox'>
        <div id='credits'>
            &raquo; Substance: <a href='http://wordpress.org/'>WordPress</a>
            &raquo; Style: <a href='http://ahren.org/code/tanish-wp'>Audacity of Tanish</a>
        </div>
        <br clear='all' />
    </div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>


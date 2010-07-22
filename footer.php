
</div> <!-- container -->
</div> <!-- bgtilediv -->

<?php get_sidebar(); ?>

<?php global $options; if( $options['showcredits'] == 1 ) : ?>
    <div id='creditsbox'>
        <div id='credits'>
            &#9679; Substance: <a href='http://wordpress.org/'>WordPress</a>
            &#9679; Style: <a href='http://ahren.org/code/tanish-wp'>Audacity of Tanish</a>
        </div>
        <br clear='all' />
    </div>
<?php endif; ?>

<div id="bubbletemplate">
<div class='bubble'>
    <span class="content"></span>
    <div class="pointer"></div>
</div>
</div>

<?php wp_footer(); ?>

</body>

</html>


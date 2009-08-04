<?php global $options; ?>

<!--
<div id='sidebartab'>
    S<br />I<br />D<br />E<br />B<br />A<br />R
</div>
-->

<div id='bottombarbox'>

    <div class='bottombar'>

        <?php if( $options['showauthors'] == 1 ) : ?>
            <div class='sidebarlist'>
                <div class='sbtitle'>
                            <img alt='' height='10' src='
                                <?php print get_bloginfo('template_directory') . "/images/down.png"; ?>
                                ' />
                            Authors
                </div>
                <div class='sbcontent'>
                    <ul>
                        <?php wp_list_authors("optioncount=0&exclude_admin=0"); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('bottombarleft') ) : ?>

            <div class='sidebarlist'>
                <div class='sbtitle'>Categories</div>
                <div class='sbcontent'>
                    <ul>
                        <?php wp_list_categories('title_li=&hierarchical=0'); ?>
                    </ul>
                </div>
            </div>

            <div class='sidebarlist'>
                <div class='sbtitle'>Archives</div>
                <div class='sbcontent'>
                    <ul>
                        <?php wp_get_archives('type=monthly'); ?>
                    </ul>
                </div>
            </div>

        <?php endif; ?>

    </div> <!-- end bottombar left -->

    <div class='bottombar'>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('bottombarcenter') ) : ?>
        <?php endif; ?>
    </div>

    <div class='bottombar'>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('bottombarright') ) : ?>
        <?php endif; ?>
    </div>
 
    <br clear='all' />

</div>


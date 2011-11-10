
<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">

            <div class='post-title-bar'>

                <div class='post-title-prefix'>&bull;</div>

                <div class='dateauthor'>
                    <?php the_time('M jS, Y'); ?> by <?php the_author(); ?>
                </div>

                <div class='heading'>
                    <?php $title = get_the_title() or $title = "(no title)"; print $title; ?>
                </div>

                <div class='divclear'></div>

            </div>

            <?php
                if(function_exists('get_avatar'))
                    echo get_avatar(get_the_author_id(), '50');
            ?>

            <div class='postmetabox'>

                <div class='postmetabutton'>
                    <img
                        src='<?php print get_bloginfo('template_url') . "/images/info.png"; ?>'
                        alt='Info'
                        title='View Post Info' />
                </div>

                <div class='postmetadata'>

                    <div>
                        <ul>
                            <li>
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                    title="Permanent Link to <?php the_title(); ?>">Permalink</a>
                            </li>
                        </ul>
                    </div>

                    <?php edit_post_link('Edit Entry', '<div><ul><li>', '</li></ul></div>'); ?>

                    <?php if( ! is_single() ): ?>
                    <div>
                        <li>
                            <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
                        </li>
                    </div>
                    <?php endif; ?>

                    <?php if( get_the_category() ) : ?>
                        <div id='postcats-<?php the_ID(); ?>' class='postcats'>
                            <h4>Categories</h4>
                            <?php
                                foreach((get_the_category()) as $cat)
                                {
                                    print
                                        "<a href='" . get_category_link($cat->cat_ID) . "'>&raquo; " .
                                        "$cat->cat_name</a><br />";
                                }
                            ?>
                            <br clear='all' />
                        </div>
                    <?php endif; ?>

                    <?php if( get_the_tags() ) : ?>
                        <div id='posttags-<?php the_ID(); ?>' class='posttags'>
                            <h4>Tags</h4>
                            <?php
                                print
                                    get_the_tag_list(
                                            $before = '&raquo; ',
                                            $sep = '<br />&raquo; ',
                                            $after = '');
                            ?> 
                            <br clear='all' />
                        </div>
                    <?php endif; ?>

                </div> <!-- end postmeta -->

            </div> <!-- end postmetabox -->

            <div class='entry'>

                <?php the_content('', FALSE, ''); ?>

                <a
                        class='morelink'
                        title='Click to view post and comments'
                        href='<?php the_permalink(); ?>'>Read the full post and comments &raquo;</a>

                <br clear='all' />

            </div> <!-- entry -->

        </div> <!-- post -->

    <?php endwhile; ?>

<?php else : ?>

    <div class="post">
        <div class='heading'>Not Found</div>
            <br/>
            <div class='entry'>
                Sorry, but you are looking for something that isn't here.
                <br/>
                <br/>
            </div>
        </div>
    </div>

<?php endif; ?>

<br clear='all' />


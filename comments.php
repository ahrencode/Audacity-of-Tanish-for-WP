<?php

if ( function_exists('wp_list_comments') ) :

// new comments.php stuff

    if (!empty($_SERVER['SCRIPT_FILENAME']) &&
            'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die('Please do not load this page directly. Thanks!');

    // password check
    if ( post_password_required() )
    {
        print '
            <p class="nocomments">
                This post is password protected.
                Enter the password to view comments.
            </p>
            ';
        return;
    }

    ?>

    <div id='comments'>

        <a href='<?php print get_post_comments_feed_link(); ?>'>
        <img border=0 align='right' width='32' height='32'
            src='<?php print bloginfo('template_directory') . "/images/rssorange.png"; ?>'></a>

        <div id='commentsheader' class='heading'>
            <img alt='' title='' align='middle'
                src='<?php print get_bloginfo('template_url') . "/images/bubble_48.png"; ?>'>
            Read Comments and Respond
        </div>

        <i><?php comments_number('No Responses', 'One Response', '% Responses' );?></i>

        <br />
        <br />

        <div id='commentscontainer'>
        <?php if ( have_comments() ) : ?>

            <?php wp_list_comments('type=all&avatar_size=48'); ?>

            <div class="navigation">
                <?php
                    previous_comments_link('<span style="float: left;">&laquo; previous</span>');
                    next_comments_link('<span style="float: right;">next &raquo;</span>');
                ?>
                <br clear='all'/>
            </div>

        <?php else : // this is displayed if there are no comments so far ?>

            <?php

                if( comments_open() ) :
                    // If comments are open, but there are no comments.

                else :
                    // comments are closed ?>
                    <!-- If comments are closed. -->
                    <span class='nocomments'>
                        Comments are closed
                    </span>

            <?php endif;

        endif; // have_comments()

        // REPLY/RESPONSE FORM

        if ( comments_open() ) : ?>

            <div id="respond">

                <div class='heading'>

                    <?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?>

                    <span class="cancel-comment-reply">
                        <?php cancel_comment_reply_link(); ?>
                    </span>

                </div>

                <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>

                    <div class='responduser'>
                        You must be
                        <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a>
                        to post a comment.
                    </div>

                <?php else : ?>

                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php"
                        method="post" id="commentform">

                    <?php if ( is_user_logged_in() ) : ?>

                        <div class='responduser'>
                            Logged in as
                            <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
                            <?php echo $user_identity; ?></a>.
                            <a href="<?php echo wp_logout_url(get_permalink()); ?>"
                                title="Log out of this account">Log out &raquo;</a>
                        </div>

                    <?php else : ?>

                        <p class='respondfield'>
                            <input type="text" name="author" id="author"
                                value=
                                "
                                    <?php
                                        // TODO: remove when 2.7 obsolete
                                        if( function_exists(esc_attr) )
                                            echo @esc_attr($comment_author);
                                        else
                                            echo $comment_author;
                                    ?>
                                "
                                size="22" tabindex="1"
                                <?php if ($req) echo "aria-required='true'"; ?> />
                            <label for="author">
                                Name <?php if ($req) echo "(required)"; ?>
                            </label>
                        </p>

                        <p class='respondfield'>
                            <input type="text" name="email" id="email"
                                "
                                    <?php
                                        // TODO: remove when 2.7 obsolete
                                        if( function_exists(esc_attr) )
                                            echo @esc_attr($comment_author_email);
                                        else
                                            echo $comment_author_email;
                                    ?>
                                "
                                size="22" tabindex="2"
                                <?php if ($req) echo "aria-required='true'"; ?> />
                            <label for="email">
                                    Mail (will not be published)
                                    <?php if ($req) echo "(required)"; ?>
                            </label>
                        </p>

                        <p class='respondfield'>
                            <input type="text" name="url" id="url"
                                value=
                                "
                                    <?php
                                        // TODO: remove when 2.7 obsolete
                                        if( function_exists(esc_attr) )
                                            echo @esc_attr($comment_author_url);
                                        else
                                            echo $comment_author_url;
                                    ?>
                                "
                                size="22" tabindex="3" />
                            <label for="url">Website</label></p>

                    <?php endif; ?>

                    <!--
                    <p>
                    <small>
                        <strong>XHTML:</strong> You can use these tags:
                        <code><?php //echo allowed_tags(); ?></code>
                    </small>
                    </p>
                    -->

                    <p>
                        <textarea name="comment" id="comment" rows="10"
                            tabindex="4"></textarea>
                    </p>

                    <p>
                        <input name="submit" type="submit" id="submit" tabindex="5"
                        value="Submit Comment" />
                        <?php comment_id_fields(); ?>
                    </p>

                    <?php do_action('comment_form', $post->ID); ?>

                </form>

                <?php endif; // If registration required and not logged in ?>

            </div> <!-- id=respond -->

        <?php endif; // commments open then show response box ?>
        </div> <!-- id=commentscontainer -->

    </div> <!-- comments -->

<?php else : // old WP < 2.7

    // Do not delete these lines
    if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if(!empty($post->post_password)) // if there's a password
    {
        if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password)  // and it doesn't match the cookie
        {
            ?>
            <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
            <?php
            return;
        }
    }

?>

    <div>

        Sorry this theme does not support comments yet for versions of WordPress &lt; 2.7.

    </div>

<?php endif; // WP 2.7 check (old vs new style of comments) ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

    <meta
        http-equiv="Content-Type"
        content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"
    />

    <title>
        <?php bloginfo('name'); ?>
        <?php if ( is_single() ) { ?>
            &raquo; Blog Archive
        <?php } ?>
        <?php wp_title(); ?>
    </title>

    <meta
        name="generator"
        content="WordPress <?php bloginfo('version'); ?>"
    /> <!-- leave this for stats -->

    <link
        rel="stylesheet"
        href="<?php bloginfo('stylesheet_url'); ?>"
        type="text/css" media="screen"
    />

    <link
        rel="alternate"
        type="application/rss+xml"
        title="<?php bloginfo('name'); ?> RSS Feed"
        href="<?php bloginfo('rss2_url'); ?>"
    />

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php
        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        wp_head();
    ?>

    <script type="text/javascript" src="<?php print get_bloginfo('template_url').'/jquery-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php print get_bloginfo('template_url').'/tanish.js'; ?>"></script>

    <!-- load shortcode handlers -->
    <?php include_once("shortcodes.php"); ?>

    <!-- set backgrounds, credits, etc based on user preference -->

    <style type='text/css'>

        <?php print bg_images_css("#bgtilediv", 'mainbgtile', 'bgtile', "repeat top left"); ?>
        <?php print bg_images_css("#container", 'mainbgimage', 'bgimage', "no-repeat 70% 0%"); ?>

    </style>

    <?php print comments_hide_html(); ?>

    <?php

        // Load custom stylesheet
        if( file_exists(TEMPLATEPATH . "/custom.css") )
        {
            $customstylesheet = get_bloginfo('template_url') . "/custom.css";
            print "<link rel='stylesheet' href='$customstylesheet' type='text/css' media='screen'>\n";
        }

    ?>

</head>

<body>

<?php if( $options['iewarn'] == 1 ) : ?>
    <div id='upgrademsie'>
        <a href='http://apple.com/safari/'>
        <img
            border=0
            src='http://dl.getdropbox.com/u/1547415/general/icons/safari.png'
            alt='Safari'
            title='Safari'
        />
        <a href='http://getfirefox.com/'>
        <img
            border=0
            src='http://dl.getdropbox.com/u/1547415/general/icons/firefox.png'
            alt='Firefox'
            title='Firefox'
        />
        </a>
        <a href='http://apple.com/safari/'>
        <img
            border=0
            src='http://dl.getdropbox.com/u/1547415/general/icons/chrome.png'
            alt='Chrome'
            title='Chrome'
        />
        </a>
        You are using Internet Explorer. Have you considered upgrading?
        <br clear='all' />
    </div>
<?php endif; ?>

<!--
    without this extra wrapper div, setting background seems impossible. Setting
    background for BODY causes incomplete tiling at the bottom when a post title
    is clicked and the post expands down.
-->

<div id='bgtilediv'>
<div id='container'>

    <div id='rsslink'>
        <a href='<?php bloginfo("rss2_url"); ?>'>
        <img border='0' align='top' alt='Site RSS'
            src='<?php print get_bloginfo('template_directory') . "/images/rssgreen.png"; ?>'>
        </a>
    </div>

    <div id='header'>
        <div id='title' class='heading'>
            <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
        </div>
        <div id='description'> <?php bloginfo('description'); ?></div>
        <br clear='all' />
    </div>


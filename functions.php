<?php

$mainbgimages = array
                (
                    "None", "Random", "Butterfly", "Dolphin", "Elephant", "Froggy",
                    "Lion", "Panda", "Pen", "Penguin", "Toucan"
                );

if( ! is_array(get_option('tanish')) )
    add_option('tanish', array('init' => 1));

$options = get_option('tanish');

# defaults
if( ! isset($options['showauthors']) ) $options['showauthors'] = 1;
if( ! isset($options['mainbgimage']) ) $options['mainbgimage'] = 'None';
if( ! isset($options['iewarn'     ]) ) $options['iewarn'     ] = 0;
# end defaults

update_option('tanish', $options);

# setup admin menu
add_action('admin_menu', 'tanish_admin_menu');

if ( function_exists('register_sidebar') )
    add_sidebars();



//-------------------------------------------------------------------------------
function tanish_admin_menu()
{
    add_theme_page('Tanish Options', 'Tanish Options', 'edit_themes', "Audacity of Tanish", 'tanish_options');
}

//-------------------------------------------------------------------------------
function tanish_options()
{
    global $options, $mainbgimages;

    if( $_POST['action'] == 'save' )
        save_options();

    print
    "
        <div style=
                '
                    clear: right;
                    float: right;
                    margin-top: 10px;
                    margin-right: 0px;
                    margin-left: 20px;
                    background-color: #fff3cc;
                    color: #000000;
                    padding: 10px 15px;
                    border: 2px solid #ddc055; width: 25%;
                    border-right: none;
                    width: 150px;
                '
        >
            <h3>Keep up with Audacity of Tanish</h3>

            <p>
                Follow on Ahren Code blog or Twitter, or join the Facebook Page.
            </p>

            <ul>
            <li style='list-style-type: circle; margin-left: 10px;'>
                Blog:
                <ul>
                <li><a href='http://ahren.org/code/tag/tanish-wp'>Audacity of Tanish</a></li>
                <li><a href='http://ahren.org/code/'>Ahren Code</a></li>
                </ul>
            </li>
            <li style='list-style-type: circle; margin-left: 10px;'>
                Twitter:
                <ul>
                <li><a href='http://search.twitter.com/search?q=%23tanish-wp'>Audacity of Tanish</a></li>
                <li><a href='http://twitter.com/ahrencode/'>Ahren Code</a></li>
                </ul>
            </li>
            <li style='list-style-type: circle;  margin-left: 10px;'>
                <a
                href='http://www.facebook.com/home.php#/pages/Ahren-Code/64305786260'>Facebook</a>
            </li>
            <li style='list-style-type: circle;  margin-left: 10px;'>
                <a href='http://github.com/ahrencode/Audacity-of-Tanish-for-WP/issues'>Bugs and
                Features</a>
            </li>
            </ul>
        </div>

        <form id='settings' action='' method='post' class='themeform'
            style='margin: 20px;'>

            <h3>General</h3>

            <input type='hidden' id='action' name='action' value='save'>

            <input type='checkbox' name='showauthors' id='showauthors'" .
                ($options['showauthors'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showauthors'>Show Authors in Sidebar</label>

            <br />

            <input type='checkbox' name='iewarn' id='iewarn'" .
                ($options['iewarn'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='iewarn'>
                Offer helpful upgrade suggestions to Internet Explorer users ;-)
            </label>

            <br/>
            <br/>

            <h3>Background Image</h3>

            <label for='mainbgimage'>Choose main background image:</label><br />

            <br/>

    ";

    $ctr = 1;
    foreach( $mainbgimages as $image )
    {
        if( $ctr > 0 && ($ctr % 3) == 0 )
            print "<br /><br />\n";

        $ctr++;

        $checked = "";
        if( $options['mainbgimage'] == $image )
            $checked = "checked";

        print "<input type='radio' name='mainbgimage' value='$image' $checked>";
        if( $image == "None" || $image == "Random" )
            print $image;
        else
            print "<img alt='$image' title='$image' height='32' align='middle'
                    src='" . get_bloginfo('template_directory') . "/images/$image.png' />";

        print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }

    print
    "
            <br/>
            <br/>
            <hr size='1'/>


            <p class='submit'><input type='submit' value='Save Changes' name='save'/></p>

        </form>

        <div style='width: 60%; margin-top: 50px; background-color: #cceeff; border: 1px solid #88bbcc; padding:
       30px;'>
            Icons courtesy of:
                <a href='http://www.Tutorial9.net/'>Tutorial9</a>
                (Designer: <a href='http://www.ilovecolors.com.ar/'>ilovecolors</a>),
                <a href='http://jonasraskdesign.com'>JONASRASKDESIGN</a>,
                <a href='http://www.visualpharm.com/animals_icon_set/'>VisualPharm</a>,
                <a href='http://pixel-mixer.com/'>Pixel Mixer</a>,
                <a href='http://c9-d.com/blog-105.html#nav'>C9 Design Rinoa icons</a>,
                <a href='http://www.icojoy.com'>Icojoy</a>,
                <a href='http://www.midtonedesign.com'>midtone design</a>
        </div>
                
    ";
}

function save_options()
{
    global $_POST, $options;

    $options['showauthors']     = ( isset($_POST['showauthors']) ) ? 1 : 0;
    $options['iewarn']          = ( isset($_POST['iewarn'     ]) ) ? 1 : 0;
    $options['mainbgimage']     = ( isset($_POST['mainbgimage']) ) ? $_POST['mainbgimage'] : "None";

    update_option('tanish', $options);

    print
    "
        <div class='updated fade' id='message'
            style='background-color: rgb(255, 251, 204);
                    width: 300px;
                    margin-top: 30px;
                    margin-left: 20px'>
            <p>Tanish Settings <strong>saved</strong>.</p>
        </div>
    ";
}

//------------------------------------------------------------------------------
function add_sidebars()
{
    register_sidebar(array(
        'name' => 'bottombarleft',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><span class='sbcontent'>",
        'after_widget' => "</span></div>",
    ));

    register_sidebar(array(
        'name' => 'bottombarcenter',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><span class='sbcontent'>",
        'after_widget' => "</span></div>",
    ));

    register_sidebar(array(
        'name' => 'bottombarright',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><span class='sbcontent'>",
        'after_widget' => "</span></div>",
    ));
}

?>

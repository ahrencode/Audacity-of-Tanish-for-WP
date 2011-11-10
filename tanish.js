
$(document).ready
(
    function()
    {
        // IE specific hacks to deal with the fact that if you have any floating element
        // inside another, then the inside one's width is set to 100%!
        if( $.browser.msie )
        {
            $('#indexpage .postmetabutton').css('float', 'none');

            // a few other things while we are at it
            $('#comments').css('margin-top', '120px');

            $('#upgrademsie').fadeIn('slow');
            setTimeout(function() { $('#upgrademsie').fadeOut('slow'); }, 8000);

            $('.postmetadata DIV:last-child').css('border-bottom', 'none');
            $('.entry UL LI:last-child, .entry OL LI:last-child').css('border-bottom', 'none');
        }

        $('#credits').mouseover( function() { $(this).css('background-color', '#bb2200'); } );
        $('#credits').mouseout( function() { $(this).css('background-color', '#111111'); } );

        $('#indexpage .post-title-bar').click(showIndexPost);
        $('#indexpage .postmetabutton').click(togglePostMeta);

        $('.sbtitle').click(toggleSBList);
        //$('#bottombarbox').mouseover(function() { $(this).find('.bottombar').show(); });
        //$('#bottombarbox').mouseout(function() { $(this).find('.bottombar').hide(); });

        $('#single .postmetadata').fadeTo('slow', 0.4);
        $('#single .postmetadata').mouseenter( function() { $(this).fadeTo('fast', 1.0); } );
        $('#single .postmetadata').mouseleave( function() { $(this).fadeTo('slow', 0.4); } );

        $('#indexpage').hint({msg: "Click on any post title below to reveal post", show: 'always'});
        $('#bottombarbox').hint({msg: "Click on section headers to reveal widget", show: 'hover'});
        $('#indexpage .postmetabox').hint({msg: "Click for post information", show: 'hover'});
        $('#commentsheader').hint({msg: "Click to view and add comments", show: 'always'});
    }
);
 

var post_selected = false;
var no_post_hints = false;
var actions_pending = 0;

function showIndexPost()
{

    if( actions_pending > 0 )
        return;

    var cur_status = $(this).parent().find('.entry').css('display');

    // should .post-selected be an id not a class? -- saving some jQuery CPU usage
    if( post_selected )
    {
        actions_pending += 2;
        $('.post-selected .postmetabox').hide();   // hide the (I) icon by hiding the postmetabox
        $('.post-selected .postmetadata').hide();
        $('.post-selected .entry').slideUp('fast',
                    function() { --actions_pending; });
        $('.post-selected').removeClass('post-selected');
        $('#indexpage .post').css('opacity', '1.0');
        post_selected = false;
        --actions_pending;
    }

    if( cur_status != 'block' )
    {
        no_post_hints = true;
        actions_pending += 2;
        post_selected = true;
        $(this).parent().addClass('post-selected');
        $(this).parent().find('.entry').slideDown('fast');
        $(this).parent().find('.postmetabox').show('slow', function() { --actions_pending; });
        $('#indexpage .post').filter(":not(.post-selected)").css('opacity', '0.8');
        --actions_pending;
    }
}


function togglePostMeta()
{
    var cur_status = $(this).parent().parent().find('.postmetadata').css('display');
    if( cur_status != 'block' )
        $(this).parent().find('.postmetadata').fadeIn('slow');
    else
        $(this).parent().find('.postmetadata').fadeOut('slow');
}


function toggleSBList()
{
    var cur_status = $(this).parent().find('.sbcontent').css('display');
    $('.sbcontent').slideUp();
    if( cur_status != 'block' )
    {
        $(this).parent().find('.sbcontent').slideDown('slow');
    }
}

/* code for hint bubble from http://paulbakaus.com/2009/10/05/a-ux-pattern-reusable-hints-with-jquery */

/*
$.fn.hint = function(msg)
{
 
    var offset = this.offset();             // generate the offset position of the hinted element

    var bubble = $('#bubbletemplate .bubble').clone().appendTo($('BODY'));  // cache the bubble as jQuery
    var pointer = $('.pointer', bubble);                    // cache the pointer of the bubble
    fadeDistance = 50;                  // the distance from where the bubble will fade in
 
    // append the message to the bubble, position it and slowly fade it in
    bubble
        .find('span.content').html(msg).end() // insert the new message
        .css({
            top: offset.top - bubble.outerHeight() - pointer.outerHeight() + this.outerHeight()/4 - fadeDistance, // the element offset minus the height of the bubble, minus the height of the pointer, plus one quarter of the height of the element to be on top of it, minus the fading distance
            left: offset.left + this.outerWidth()*0.75 - 42 // the element offset + 3/4 of the element's width to position the bubble at the right side, minus the pixel width to the edge of the triangle
        })
        .animate({
            opacity: 1, // fades it in
            top: '+='+fadeDistance+'px' // moves it in from the fade distance that we substracted above
        }, 600);
 
    // make sure the bubble goes away when clicking on the hinted element
    return this.one('click', function() {
        bubble.animate({
            opacity: 0, // fades out
            top: '-='+fadeDistance+'px' // animate back the fade distance
        }, 300);
    });
};

*/

var fadeDistance = 50;                  // the distance from where the bubble will fade in

$.fn.hint = function(args)
{
 
    var bubble = $('#bubbletemplate .bubble').clone().appendTo($('BODY'));  // cache the bubble as jQuery
    // append the message to the bubble, position it and slowly fade it in
    bubble.find('span.content').html(args.msg); // insert the new message

    if( args.show == 'hover' )
    {
        positionBubble($(this), bubble);
        $(this).hover
        (
            function() { showHint($(this), bubble); },
            function() { hideHint(bubble); }
        );
    }
    else
        showHint($(this), bubble);

    $(this).click
    (
        function()
        {
            hideHint(bubble);
            $(this).unbind('mouseover').unbind('mouseout');
        }
    );
};

function showHint(element, bubble)
{
    positionBubble(element, bubble);
    bubble.animate
        (
            {
                opacity: 0.9, // fades it in
                // moves it in from the fade distance that we substracted above
                top: '+='+fadeDistance+'px'
            },
            600
        );
}

function positionBubble(element, bubble)
{
    var pointer = $('.pointer', bubble);    // cache the pointer of the bubble
    var offset = $(element).offset();       // generate the offset position of the hinted element
            
    // the element offset minus the height of the bubble, minus the height of the
    // pointer, plus one quarter of the height of the element to be on top of it,
    // minus the fading distance
    var bubbletop = offset.top - bubble.outerHeight() - pointer.outerHeight()
                        + $(element).outerHeight()/4 - fadeDistance;
    // the element offset + 3/4 of the element's width to position the bubble at
    // the right side, minus the pixel width to the edge of the triangle
    var bubbleleft = offset.left + $(element).outerWidth()*0.75 - 42;

    bubble.css({ top: bubbletop, left: bubbleleft });
}

function hideHint(bubble)
{
    $(bubble).animate
    (
        {
            opacity: 0, // fades out
            top: '-='+fadeDistance+'px' // animate back the fade distance
        },
        300
    );
}



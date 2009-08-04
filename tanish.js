
$(document).ready
(
    function()
    {
        $('.posttitlebar').click(showIndexPost);
        $('.showpostmeta').click(togglePostMeta);
        //$('#bottombarbox').mouseover(function() { $(this).find('.bottombar').show(); });
        //$('#bottombarbox').mouseout(function() { $(this).find('.bottombar').hide(); });
        $('.sbtitle').click(toggleSBList);
        //$('#comments').mouseover(function(){ $(this).css('opacity', '1.0'); });
        //$('#comments').mouseout(function(){ $(this).css('opacity', '0.4'); });
    }
);
 

function showIndexPost()
{
    var curstatus = $(this).parent().find('.entry').css('display');

    $('.entry').slideUp();
    $('.postmetabox').hide();   // hide the I icon by hiding the postmetabox
    $('.postmetadata').hide();
    $('.post').removeClass('postselected');

    if( curstatus != 'block' )
    {
        $(this).parent().addClass('postselected');
        $(this).parent().find('.entry').slideDown('slow');
        $(this).parent().find('.postmetabox').show('slow');
    }
}


function togglePostMeta()
{
    var curstatus = $(this).parent().parent().find('.postmetadata').css('display');
    $('.clearpostmetafloat').hide();
    if( curstatus != 'block' )
    {
        $(this).parent().parent().find('.clearpostmetafloat').show();
        $(this).parent().find('.postmetadata').fadeIn('slow');
    }
    else
        $(this).parent().find('.postmetadata').fadeOut('slow');
}


function toggleSBList()
{
    var curstatus = $(this).parent().find('.sbcontent').css('display');
    $('.sbcontent').slideUp();
    if( curstatus != 'block' )
    {
        $(this).parent().find('.sbcontent').slideDown('slow');
    }
}


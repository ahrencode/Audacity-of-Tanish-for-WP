
$(document).ready
(
    function()
    {
        alert("Click on sections to set their fonts and colours. Remember to save when done!");

        $('#main').click( function(e) { e.stopPropagation(); } );
        $('#bgtop').click( function(e) { alert("Hey2"); e.stopPropagation(); } );
        $('#rsslinks').click( function(e) { e.stopPropagation(); } );
        $('#credits').click( function(e) { e.stopPropagation(); } );
        $('#maincontainer').click(function() { alert("hey"); });
    }
);


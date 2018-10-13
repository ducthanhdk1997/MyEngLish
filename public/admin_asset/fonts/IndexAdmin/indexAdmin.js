

$(document).ready(function(){
    $("#yourBtn").click(function(){
        $("#upimage").click();
    });
});

$(function() {
    $( window ).resize(function() {
        var aftersize = $(document).width();
        var panel = $("#panelright");

            if(992<=aftersize<=1100)
            {
                panel.width("270px");
            }
            if(768<aftersize<992)
            {
                panel.width("200px");
            }
            if(768>=aftersize)
            {
               panel.width(0);
            }
            if(1100<aftersize)
            {
              panel.width("300px");
            }
    });
});
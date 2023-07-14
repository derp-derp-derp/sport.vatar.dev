$(document).ready(function(){
    var tap = ("ontouchstart" in document.documentElement);
    if(!tap)
    {
        // these effects are only for desktop
        $('.content-card').on( "mouseenter", function(){
            $(this).find("img").show();
            $(this).find("span").hide();
        }).on( "mouseleave", function(){
            $(this).find("img").hide();
            $(this).find("span").show();
        });
    }
});
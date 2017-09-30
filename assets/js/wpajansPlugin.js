jQuery(function($){
    var title = $("#title").val();
    var faviconURI = $("#faviconURI").val();
    $(".corner span").text(title);
    $(".corner img").attr("src",faviconURI);
    $("#title").keyup(function(){
        var title = $("#title").val();
        $(".corner span").text(title);
    });
    $("#faviconURI").keyup(function(){
        var faviconURI = $("#faviconURI").val();
        $(".corner img").attr("src",faviconURI);
    });
});

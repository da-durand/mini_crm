$(document).ready(function(){

    $("#accordionExample-2").hide();
    $("#btn-client").css("background", "purple").css("color", "white");
    $("#btn-entreprise").css("background", "none").css("color", "purple");


    $("#btn-entreprise").click(function(){
        $("#accordionExample-2").show();
        $("#accordionExample").hide();
        $(this).css("background","purple").css("color", "white");
        $("#btn-client").css("background", "none").css("color", "purple");

    })

    $("#btn-client").click(function(){
        $("#accordionExample").show();
        $("#accordionExample-2").hide();
        $(this).css("background","purple").css("color", "white");
        $("#btn-entreprise").css("background", "none").css("color", "purple");
    })

})
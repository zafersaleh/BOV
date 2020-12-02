/*global $, jQuery, alert, console*/
$(function () {
    "use strict";
   /* Bank Information */
    $("#info_1").click(function (){
        $("#info_line").animate({
            margin: '0px 9% 25px'
        }, 1000);

        $("#our_vision, #our_messege, #our_targets, #our_value").fadeOut(200, function(){
            $("#about_us").fadeIn();
        });
    });
    $("#info_1").click();

    $("#info_2").click(function (){
        $("#info_line").animate({
            margin: '0px 24.5% 25px'
        }, 1000);

        $("#about_us, #our_messege, #our_targets, #our_value").fadeOut(200, function(){
            $("#our_vision").fadeIn();
        });
    });

    $("#info_3").click(function (){
        $("#info_line").animate({
            margin: '0px 42.5% 25px'
        }, 1000);

        $("#about_us, #our_vision, #our_targets, #our_value").fadeOut(200, function(){
            $("#our_messege").fadeIn();
        });
    });

    $("#info_4").click(function (){
        $("#info_line").animate({
            margin: '0px 60.5% 25px'
        }, 1000);

        $("#about_us, #our_vision, #our_messege, #our_value").fadeOut(200, function(){
            $("#our_targets").fadeIn();
        });
    });


     $("#info_5").click(function (){
        $("#info_line").animate({
            margin: '0px 79.5% 25px'
        }, 1000);

        $("#about_us, #our_vision, #our_messege, #our_targets").fadeOut(200, function(){
            $("#our_value").fadeIn();
        });
    });



    /* Managers */
    $("#mang_1").click(function (){
        $("#info_line_2").animate({
            margin: '0px 8% 25px'
        }, 1000);

        $(".mangB, .mangC, .mangD, .mangE").fadeOut(200, function(){
            $(".mangA").fadeIn();
        });
    });
    $("#mang_1").click();

    $("#mang_2").click(function (){
        $("#info_line_2").animate({
            margin: '0px 25.5% 25px'
        }, 1000);

        $(".mangA, .mangC, .mangD, .mangE").fadeOut(200, function(){
            $(".mangB").fadeIn();
        });
    });

    $("#mang_3").click(function (){
        $("#info_line_2").animate({
            margin: '0px 42% 25px'
        }, 1000);

        $(".mangA, .mangB, .mangD, .mangE").fadeOut(200, function(){
            $(".mangC").fadeIn();
        });
    });

    $("#mang_4").click(function (){
        $("#info_line_2").animate({
            margin: '0px 60% 25px'
        }, 1000);

        $(".mangA, .mangB, .mangC, .mangE").fadeOut(200, function(){
            $(".mangD").fadeIn();
        });
    });

    $("#mang_5").click(function (){
        $("#info_line_2").animate({
            margin: '0px 79% 25px'
        }, 1000);

        $(".mangA, .mangB, .mangC, .mangD").fadeOut(200, function(){
            $(".mangE").fadeIn();
        });
    });
});

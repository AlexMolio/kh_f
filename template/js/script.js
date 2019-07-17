$(document).ready(function(){


if($("#content_status :selected").val() == 1){

            $('.video_type').css("display", "block");
            $('.img_type').css("display", "none");
        }

        if($("#content_status :selected").val() == 0){

            $('.video_type').css("display", "none");
            $('.img_type').css("display", "block");
        }


    $( "select" ).change(function() {

        

        if($("#content_status :selected").val() == 1){

            $('.video_type').css("display", "block");
            $('.img_type').css("display", "none");
        }

        if($("#content_status :selected").val() == 0){

            $('.video_type').css("display", "none");
            $('.img_type').css("display", "block");
        }
    });

    

});
$(document).ready(function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        console.log('gelukt');
    }
})


function showPosition(position) {
    var lat = position.coords.latitude
    var long = position.coords.longitude
    $('.lattitude').val(lat);
    $('.longitude').val(long);
    /*this.call(myMap(lat, long));*/
}


// Star rating ************************************************************
$(document).ready(function(){

    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li, #stars2 li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('#stars li, #stars2 li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // RESPONSE
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        $('#ratingSterren').val(ratingValue);
        if(isNaN(ratingValue)){
            msg = "Gelieve een rating voor poperheid te geven."
        }else if (ratingValue > 1) {
            msg = "Bedankt! U gaf dit toilet " + ratingValue + " sterren voor properheid.";
        }
        else {
            msg = "Bedankt! U gaf dit toilet " + ratingValue + " ster voor properheid.";
        }
        responseMessage(msg);

        var ratingValue2 = parseInt($('#stars2 li.selected').last().data('value'), 10);
        var mess2 = "";
        $('#ratingSterren2').val(ratingValue2);
        if(isNaN(ratingValue2)) {
            mess2 = "Gelieve een rating voor toegankelijkheid te geven.";
        } else if(ratingValue2 > 1) {
            mess2 = "Bedankt! U gaf dit toilet " + ratingValue2 + " sterren voor toegankelijkheid.";
        } else {
            mess2 = "Bedankt! U gaf dit toilet " + ratingValue2 + " ster voor toegankelijkheid.";
        }
        responseMessage2(mess2);

    });


});


function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
function responseMessage2(mess2) {
    $('.success-box2').fadeIn(200);
    $('.success-box2 div.text-message').html("<span>" + mess2 + "</span>");
}


// google map **************************************************************************************

/*
function myMap(lat, long) {
    var you = {lat: lat, lng: long};
    /!*var T = {lat:, lng:};*!/
    var map = new google.maps.Map(
        document.getElementById('googleMap'), {zoom: 12, center: you});
    // The markers
    var markerYou = new google.maps.Marker({position: you, map: map});
    /!*var markerT = new google.maps.Marker({position: T, map: map});*!/
}
*/


$('#customSwitch1').click(function(){
    var waarde = $('#customSwitch1').val();
    console.log(waarde);
})


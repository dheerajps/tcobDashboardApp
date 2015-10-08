﻿/*
 * When you select a topic from the menu
 * 
 * TO CHANGE: Fix logic around when data for topics and sections are loaded dynamically
 */ 
$(document).on('click', ".btn.topic-buttons.nav-buttons", function (event) {
    // One variable will measure the position from the top of the page to the div, and one measures
    // from the currently selected topic to the top of the page (confusing but it works, don't question it)  :)
    var topPosition = $(event.target).closest(".nav-buttons-wrapper").offset().top,
        topOffset = $(event.target).closest('#dashboard-topics').offset().top;

    // Changes styling to add and remove right borders on elements to look cool
    $(event.target).closest(".nav-buttons-wrapper").addClass("active");
    $(event.target).closest(".nav-buttons-wrapper").removeClass("right-wall-topic-menu");
    $(event.target).closest(".nav-buttons-wrapper").siblings().removeClass("active");
    $(event.target).closest(".nav-buttons-wrapper").siblings().addClass("right-wall-topic-menu");

    // If the currently selected topic's content is hidden
    if ($('.dashboard-sections-wrapper').is(':hidden')) {
        $('#no-topics').hide();
        $('.dashboard-sections-wrapper').show(); // Shows the div containing the list of sections instead of the message 
    }

    // Fade the content of the section names in 
    // TO CHANGE: Show the specfic div for that topic, still fade it in each time, but find a way to distinguish a topic's section div from others, and hide the others
    $('.dashboard-sections').fadeIn(); // Will automatically "show" the div, need to hide the others 
    // ------------- (AS OF RIGHT NOW... this only changes the position of the dummy data, it doesn't "re show" new data) -------------

    //Position the sections-list div to the right vertical height to match the selected topic
    $('#sections-list').css('margin-top', (topPosition - topOffset));
});

$(document).on('click', 'li.dashboard-button', function () {
    var backButton = "<button type='button' id='back-button'>Back</button>";
    $("#cyfe-iframe").attr('src', 'https://app.cyfe.com/dashboards/682/4f1e480ccb8cf101202552286564');
    $("#menu-nav").hide();
    $("#header-link").before(backButton);
    $("#cyfe-display").fadeIn();
    $('#content').css('background-color', '#333');

    //Change the page around
    $('#page').attr('id', 'hidden-page');
    //$('#logout').addClass('page');
    $('#header-wrapper').addClass('page');

    //Store the current settings into sessionstorage
});

$(document).on('click', '#back-button', function (event) {
    event.stopPropagation();
    $('#back-button').remove();
    $("#cyfe-display").hide();
    $("#menu-nav").css('display', 'block');
    $("#cyfe-iframe").attr('src', '');
    $('#content').css('background-color', '#fff');

    //Change the page back to normal template
    $('#hidden-page').attr('id', 'page');
    //$('#logout').removeClass('page');
    $('#header-wrapper').removeClass('page');
});

function clickCounter() {
    if (typeof (Storage) !== "undefined") {
        if (sessionStorage.clickcount) {
            sessionStorage.clickcount = Number(sessionStorage.clickcount) + 1;
        } else {
            sessionStorage.clickcount = 1;
        }
        document.getElementById("result").innerHTML = "You have clicked the button " + sessionStorage.clickcount + " time(s) in this session.";
    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support web storage...";
    }
}
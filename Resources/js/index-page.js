﻿/*
 * When you select a topic from the menu
 * 
 * 
 */ 
$(document).on('click', ".btn.topic-buttons.nav-buttons", function (event) {
    // One variable will measure the position from the top of the page to the div, and one measures
    // from the currently selected topic to the top of the page (confusing but it works, don't question it)  :)
    var topPosition = $(event.target).closest(".nav-buttons-wrapper").offset().top,
        topOffset = $(event.target).closest('#dashboard-topics').offset().top,
        windowwidth = $(window).width(),
        sectionToShow = convertNameToId($(event.target).text());


    // If the currently selected topic's content is hidden
    if ($('.dashboard-sections-wrapper').is(':hidden')) {
        $('#no-topics').hide();
        $('.dashboard-sections-wrapper').show(); // Shows the div containing the list of sections instead of the message 
    }

    // If you select the topic that is already selected
    if ($(event.target).closest(".nav-buttons-wrapper").hasClass("active")) {
        $(event.target).closest(".nav-buttons-wrapper").removeClass("active");
        $('.dashboard-sections-wrapper').hide();
        $('#no-topics').show();
        $('#sections-list').css('margin-top', "0");
        $('.nav-buttons-wrapper').removeClass("right-wall-topic-menu");
        return;
    }

    // Changes styling to add and remove right borders on elements to look cool
    $(event.target).closest(".nav-buttons-wrapper").addClass("active");
    $(event.target).closest(".nav-buttons-wrapper").siblings().removeClass("active");
    $(event.target).closest(".nav-buttons-wrapper").removeClass("right-wall-topic-menu");
    $(event.target).closest(".nav-buttons-wrapper").siblings().addClass("right-wall-topic-menu");

    // If the user is on a mobile device OR tablet (tested) --- Documentation here: http://getbootstrap.com/css/#grid-options
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < 750 ) { // USE 750 because that's the media query size used in the css file, and how bootstrap does their col-xs classes
        $('#accordion').insertAfter($(event.target));
    } else {


        // TO CHANGE: Show the specfic div for that topic, still fade it in each time, but find a way to distinguish a topic's section div from others, and hide the others
        console.log(sectionToShow);
        if ($('#sections-list .dashboard-sections-wrapper').find("#"+sectionToShow) == $("#"+sectionToShow)) {
            console.log("IT WORKED");
        } else {
            console.log($('#sections-list .dashboard-sections-wrapper').find("#" + sectionToShow));
            console.log($("#" + sectionToShow));
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////


        //Position the sections-list div to the right vertical height to match the selected topic
        $('#sections-list').css('margin-top', (topPosition - topOffset));
    }
});

// When you select a dashboard from a section 
$(document).on('click', 'li.dashboard-button', function (event) {
    var backButton = "<button type='button' id='back-button'>Back</button>";

    event.preventDefault();
    $("#cyfe-iframe").attr('src', 'https://app.cyfe.com/dashboards/682/4f1e480ccb8cf101202552286564');
    $("#menu-nav").hide();
    $("#cyfe-display").before(backButton);
    $('#content').css('background-color', '#333');

    //Change the page around
    $('#page').attr('id', 'hidden-page');
    $('#header-wrapper').addClass('page');

    // Show the div with iframe
    $("#cyfe-display").fadeIn();
});

// When you click the back button on a dashboard
$(document).on('click', '#back-button', function (event) {
    $('#back-button').remove();
    $("#cyfe-display").hide();
    $("#menu-nav").css('display', 'block');
    $("#cyfe-iframe").attr('src', '');
    $('#content').css({ 'background-color': '#fff', 'padding-top' : 'none' });

    //Change the page back to normal template
    $('#hidden-page').attr('id', 'page');
    $('#header-wrapper').removeClass('page');
});

function convertNameToId(inputText) {
    var $lowerCase = inputText.toLowerCase();
    var output = $lowerCase.replace(/(\s)+/g, '-');

    return output;
}

﻿/* NOTE: isMobile not used anymore, but here is the code incase it needs to be used again: Documentation here: http://getbootstrap.com/css/#grid-options 
 * isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < mobilePixels;
 */


/*
 * When you select a topic from the menu
 */
var windowwidth = $(window).width();
var warned = false; 

$(document).on('click', ".btn.topic-buttons.nav-buttons", function (event) {
    // One variable will measure the position from the top of the page to the div, and one measures
    // from the currently selected topic to the top of the page (confusing but it works, don't question it)  :)
    var topPosition   = $(event.target).closest(".nav-buttons-wrapper").offset().top,
        topOffset     = $(event.target).closest('#dashboard-topics').offset().top,
        sectionToShow = convertNameToId((event.target).text),
        mobilePixels  = 768,
        tabletPixels = 992;

    console.log('TOP POSITION: ' + topPosition);
    console.log("TOP OFFSET: " + topOffset);

    // If the currently selected topic's content is hidden
    if ($('.dashboard-sections-wrapper').is(':hidden')) {
        $('#no-topics').hide(); 
    }

    // If you select the topic that is already selected
    if ($(event.target).closest(".nav-buttons-wrapper").hasClass("active")) {
        // Add the sections list back to the list at the bottom

        $(event.target).closest(".nav-buttons-wrapper").removeClass("active");
        $('.dashboard-sections-wrapper-wrapper').hide();
        $('#no-topics').show();
        $('#sections-list').css('margin-top', "0");
        $('.nav-buttons-wrapper').removeClass("right-wall-topic-menu");
        if (windowwidth < mobilePixels) { // USE mobilePixels variable because that's the media query size used in the css file, and how bootstrap does their col-xs classes
            $("#sections-list").append($("#" + convertNameToId($(document).find(".active .topic-buttons").text())));
            $("#sections-list").insertAfter($('#topics'));
        }
        return;
    } else {
        $("#" + convertNameToId($(document).find(".active .topic-buttons").text())).hide();
        $("#" + sectionToShow).show(); // Shows the div containing the list of sections instead of the message

        if (windowwidth < mobilePixels) { // USE mobilePixels variable because that's the media query size used in the css file, and how bootstrap does their col-xs classes
            $("#sections-list").append($("#" + convertNameToId($(document).find(".active .topic-buttons").text())));
            $("#" + sectionToShow).insertAfter($(event.target));
        } else {
            //Position the sections-list div to the right vertical height to match the selected topic
            $('#sections-list').css('margin-top', (topPosition - topOffset));
        }
    }

    // Changes styling to add and remove right borders on elements to look cool
    $(event.target).closest(".nav-buttons-wrapper").addClass("active");
    $(event.target).closest(".nav-buttons-wrapper").siblings().removeClass("active");
    $(event.target).closest(".nav-buttons-wrapper").removeClass("right-wall-topic-menu");
    $(event.target).closest(".nav-buttons-wrapper").siblings().addClass("right-wall-topic-menu");
});

// When you select a dashboard from a section 
$(document).on('click', 'li.dashboard-button a', function (event) {

    var backButton    = "<button type='button' id='back-button'>Back</button>",
        refreshButton = "<button type='button' id='refresh-button'>Refresh</button>",
        mobilePixels  = 768,
        tabletPixels  = 992;

    event.preventDefault();

    if (windowwidth < tabletPixels && warned == false) {
        if (confirm("If you are on a tablet or mobile phone, please turn it to landscape mode for better quality of dashboard. Please turn to landscape and hit the refresh button on the screen.")) {
            $("#cyfe-iframe").attr('src', $(event.target).attr('val'));
            $("#menu-nav").hide();
            $("#cyfe-display").before(backButton);
            $("#back-button").after(refreshButton);
            $('#content').css({ 'background-color': '#333' });
            warned = true; 
        }
    } else {
        $("#cyfe-iframe").attr('src', $(event.target).attr('val'));
        $("#menu-nav").hide();
        $("#cyfe-display").before(backButton);
        $("#cyfe-display").before(refreshButton);
        $('#content').css({ 'background-color': '#333' });
    }

    if (windowwidth >= mobilePixels || windowwidth >= tabletPixels) {
      $('#content').css({ 'padding-left': '0', 'padding-right': '0' });
    }

    //Change the page around
    $('#page').attr('id', 'hidden-page');
    $('#header-wrapper').addClass('page');

    // Show the div with iframe
    $("#cyfe-display").fadeIn();
});

// When you click the back button on a dashboard
$(document).on('click', '#back-button', function (event) {
    $('#back-button').remove();
    $('#refresh-button').remove();
    $("#cyfe-display").hide();
    $("#menu-nav").css('display', 'block');
    $("#cyfe-iframe").attr('src', '');
    $('#content').css({ 'background-color': '#fff', 'padding-top': 'none' });

    if (windowwidth >= mobilePixels) {
      $('#content').css({ 'padding-left': '', 'padding-right': '' });
    }

    //Change the page back to normal template
    $('#hidden-page').attr('id', 'page');
    $('#header-wrapper').removeClass('page');
});

//on clicking the refresh button for the dashboard
$(document).on('click', '#refresh-button', function (event) {
    var backButton = "<button type='button' id='back-button'>Back</button>";
    
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < 750;

    event.preventDefault();
    //$("#cyfe-iframe").attr('src', $(event.target).attr('val'));
    //window.frames["#cyfe-iframe"].location.reload();
    var cyfeIFrameReload = document.getElementById("cyfe-iframe");
    cyfeIFrameReload.src = cyfeIFrameReload.src;
    $("#menu-nav").hide();
    //$("#cyfe-display").before(refreshButton);
    
    $('#content').css({ 'background-color': '#333' });

    if (!isMobile) {
        $('#content').css({ 'padding-left': '0', 'padding-right': '0' });
    }

    //Change the page around
    $('#page').attr('id', 'hidden-page');
    $('#header-wrapper').addClass('page');

    // Show the div with iframe
    $("#cyfe-display").fadeIn();
});

function convertNameToId(inputText) {
    var $lowerCase = inputText.toLowerCase(),
        output     = $lowerCase.replace(/(\s)+/g, '-');

    return output;
}

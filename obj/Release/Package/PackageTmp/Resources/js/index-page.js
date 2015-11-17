/* 
 * NOTE: isMobile not used anymore, but here is the code incase it needs to be used again: Documentation here: http://getbootstrap.com/css/#grid-options 
 * isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < mobilePixels;
 */

/*
 * NOTE: mobilePixels and tabletPixels are the values that bootstrap uses for its col-sm and col-xs.  Documentation here: http://getbootstrap.com/css/#grid-options
 */

var windowwidth  = $(window).width(),
    warned       = false,
    mobilePixels = 768,
    tabletPixels = 992;

//When you select a topic from the menu -------------------------------------------------------------------------------------------------------------------------
$(document).on('click', ".btn.topic-buttons.nav-buttons", function (event) {
    // One variable will measure the position from the top of the page to the div, and one measures
    // from the currently selected topic to the top of the page (confusing but it works, don't question it)  :)
    var topPosition = $(event.target).closest(".nav-buttons-wrapper").offset().top,
        topOffset = $(event.target).closest('#dashboard-topics').offset().top,
        sectionToShow = convertNameToId((event.target).text);

    // If the currently selected topic's content is hidden...
    if ($('.dashboard-sections-list').is(':hidden')) {
        $('#no-topics').hide(); 
    }

    // If you select the topic that is already selected...
    if ($(event.target).closest(".nav-buttons-wrapper").hasClass("active")) {
        $(event.target).closest(".nav-buttons-wrapper").removeClass("active");
        $('.dashboard-sections-wrapper').hide();
        $('#no-topics').show();
        $('#sections-list').css('margin-top', "0");
        $('.nav-buttons-wrapper').removeClass("right-wall-topic-menu");

        // if you select the topic that is already selected AND you are on a mobile device but NOT a tablet
        if (windowwidth < mobilePixels) { 
            $("#sections-list").append($("#" + convertNameToId($(document).find(".active .topic-buttons").text())));
            $("#sections-list").insertAfter($('#topics'));
        }
        return;
    } else {
        $("#" + convertNameToId($(document).find(".active .topic-buttons").text())).hide(); // find the id of the list of sections to show
        $("#" + sectionToShow).show(); // Shows the div containing the list of sections

        // if you select a topic that wasn't just selected AND you're on a mobile device
        if (windowwidth < mobilePixels) { 
            $("#sections-list").append($("#" + convertNameToId($(document).find(".active .topic-buttons").text())));
            $("#" + sectionToShow).insertAfter($(event.target));
        } else {
            //Position the sections-list div to the right vertical height to match the selected topic
            $('#sections-list').css('margin-top', (topPosition - topOffset));
        }
    }

    // Changes styling to add and remove right borders on elements to look cool
    $(event.target).closest(".nav-buttons-wrapper").siblings().removeClass("active").addClass("right-wall-topic-menu");
    $(event.target).closest(".nav-buttons-wrapper").removeClass("right-wall-topic-menu").addClass("active");
});

// When you select a dashboard from a section ------------------------------------------------------------------------------------------------------------------------
$(document).on('click', 'li.dashboard-button a', function (event) {
    var backButton    = "<button type='button' id='back-button'>Back</button>",
        refreshButton = "<button type='button' id='refresh-button'>Refresh</button>";

    event.preventDefault();

    //Change the page around (very hacky, but had to be done)
    $('#page').attr('id', 'hidden-page');
    $('#header-wrapper').addClass('page');
    $("#menu").hide();
    $('#content').css({ 'background-color': '#333' });
    // Checks to see if the user is on a mobile device or tablet, then (on the first dashboard they load) will warn the user that they should 
    // switch their device to landscape mode since the dashboards look a lot better when the device is in that position
    if (windowwidth < tabletPixels) {
        if (!warned) {
            alert("If you are on a tablet or mobile phone, please turn it to landscape mode for better quality of dashboard. Please turn to landscape and hit the refresh button on the screen.");
            warned = true;
        }
    } else { // If the user is on a desktop machine or larger, then just load the dashboard without any warnings 
        $('#content').css({ 'padding-left': '0', 'padding-right': '0' });
    }

    // Show the div with iframe
    $("#cyfe-iframe").attr('src', $(event.target).attr('val'));
    $("#cyfe-display").show();
    $("#cyfe-display").before(backButton);
    $("#cyfe-display").before(refreshButton);
});

// When you click the back button on a dashboard --------------------------------------------------------------------------------------------------------------------
$(document).on('click', '#back-button', function (event) {
    // Undo all of the changes made to the page when a dashboard was initially selected.  Puts the page to its former build
    $('#back-button, #refresh-button').remove();
    $("#cyfe-display").hide();
    $("#menu").css('display', 'block');
    $("#cyfe-iframe").attr('src', '');
    $('#content').css({ 'background-color': '#fff', 'padding-top': 'none' });

    if (windowwidth >= mobilePixels) {
      $('#content').css({ 'padding-left': '', 'padding-right': '' });
    }

    //Change the page back to normal template
    $('#hidden-page').attr('id', 'page');
    $('#header-wrapper').removeClass('page');
});

//on clicking the refresh button for the dashboard --------------------------------------------------------------------------------------------------------------
$(document).on('click', '#refresh-button', function () {
    document.getElementById("cyfe-iframe").src = document.getElementById("cyfe-iframe").src;
});

// converts the given string into a format used for classes and IDs ----------------------------------------------------------------------------------------------
function convertNameToId(inputText) {
    var $lowerCase = inputText.toLowerCase(),
        output     = $lowerCase.replace(/(\s)+/g, '-');

    return output;
}

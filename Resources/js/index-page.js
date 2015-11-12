/*
 * When you select a topic from the menu
 * 
 * 
 */
var windowwidth = $(window).width();

$(document).on('click', ".btn.topic-buttons.nav-buttons", function (event) {
    // One variable will measure the position from the top of the page to the div, and one measures
    // from the currently selected topic to the top of the page (confusing but it works, don't question it)  :)
    var topPosition   = $(event.target).closest(".nav-buttons-wrapper").offset().top,
        topOffset     = $(event.target).closest('#dashboard-topics').offset().top,
        sectionToShow = convertNameToId((event.target).text),
        // If the user is on a mobile device OR tablet (tested) --- Documentation here: http://getbootstrap.com/css/#grid-options
        isMobile      = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < 750 ;


    // If the currently selected topic's content is hidden
    if ($('.dashboard-sections-wrapper').is(':hidden')) {
        $('#no-topics').hide(); 
    }

    // If you select the topic that is already selected
    if ($(event.target).closest(".nav-buttons-wrapper").hasClass("active")) {
        // Add the sections list back to the list at the bottom
        $("#sections-list").append($("#" + convertNameToId($(document).find(".active .topic-buttons").text())));

        $(event.target).closest(".nav-buttons-wrapper").removeClass("active");
        $('.dashboard-sections-wrapper-wrapper').hide();
        $('#no-topics').show();
        $('#sections-list').css('margin-top', "0");
        $('.nav-buttons-wrapper').removeClass("right-wall-topic-menu");
        if (isMobile) { // USE 750 because that's the media query size used in the css file, and how bootstrap does their col-xs classes
            $("#sections-list").insertAfter($('#topics'));
        }
        return;
    } else {
        $("#" + convertNameToId($(document).find(".active .topic-buttons").text())).hide();
        $("#" + sectionToShow).show(); // Shows the div containing the list of sections instead of the message

        if (isMobile) { // USE 750 because that's the media query size used in the css file, and how bootstrap does their col-xs classes
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
    var backButton = "<button type='button' id='back-button'>Back</button>";
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < 750;

    event.preventDefault();
    $("#cyfe-iframe").attr('src', $(event.target).attr('val'));
    $("#menu-nav").hide();
    $("#cyfe-display").before(backButton);
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

// When you click the back button on a dashboard
$(document).on('click', '#back-button', function (event) {
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < 750;

    $('#back-button').remove();
    $("#cyfe-display").hide();
    $("#menu-nav").css('display', 'block');
    $("#cyfe-iframe").attr('src', '');
    $('#content').css({ 'background-color': '#fff', 'padding-top': 'none' });

    if (!isMobile) {
        $('#content').css({ 'padding-left': '', 'padding-right': '' });
    }

    //Change the page back to normal template
    $('#hidden-page').attr('id', 'page');
    $('#header-wrapper').removeClass('page');
});

function convertNameToId(inputText) {
    var $lowerCase = inputText.toLowerCase();
    var output = $lowerCase.replace(/(\s)+/g, '-');

    return output;
}

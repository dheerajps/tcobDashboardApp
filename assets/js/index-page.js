/* 
 * NOTE: isMobile not used anymore, but here is the code incase it needs to be used again: Documentation here: http://getbootstrap.com/css/#grid-options 
 * isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || windowwidth < mobilePixels;
 */

/*
 * NOTE: mobilePixels and tabletPixels are the values that bootstrap uses for its col-sm and col-xs.  Documentation here: http://getbootstrap.com/css/#grid-options
 */

var windowwidth = $(window).width(),
    warned = false,
    mobilePixels = 768,
    tabletPixels = 992;


//On page load, do this
$(function () {

    //Evaluate the URL to determine what to load
    evaluatePath(location.pathname);

});

//Add a popstate event listener to handle the browser back button functionality
window.addEventListener('popstate', function (e) {
    var path = e.state; //Get the state/url

    if ($('#back-button').length) {
        hide_dashboard();
    }

    location.reload(true);
})

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
        $(event.target.offsetParent).removeClass("active");
        $('.dashboard-sections-wrapper').hide();
        $('#no-topics').show();
        $('#sections-list').css('margin-top', "0");
        $('.nav-buttons-wrapper').removeClass("right-wall-topic-menu");

        // if you select the topic that is already selected AND you are on a mobile device but NOT a tablet
        if (windowwidth < mobilePixels) {
            $("#sections-list").append($("#" + convertNameToId($(document).find(".active .topic-buttons").text())));
            $("#sections-list").insertAfter($('#topics'));
        }
        history.pushState("/", null, "/");
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
        evaluatePath(baseUrl);
    } else {
        var currentActiveSection = document.querySelector('[active-section-list="true"]');
        $(".nav-buttons-wrapper.active").removeClass("active");
        if (currentActiveSection != null) {
            //$(currentTopicName).removeClass("active");
            currentActiveSection.setAttribute('active-section-list', false);
            $(currentActiveSection).hide();
        }
        //$(document).find('[active-section-list]').hide();
        //$("#" + convertNameToId($(document).find(".active .topic-buttons").text())).hide(); // find the id of the list of sections to show
        //$(document).find(".active .topic-buttons").text();
        var newSectionToShow = document.getElementById(sectionToShow);
        newSectionToShow.setAttribute('active-section-list', true);
        $(newSectionToShow).show();
        if (newSectionToShow.children[0].children.length == 1) {
            var childSection = newSectionToShow.children[0].children[0].children[1].id;
            history.pushState("../" + sectionToShow + "/" + childSection, null, "../" + sectionToShow + "/" + childSection);
            evaluatePath(location.pathname);
        } else {
            history.pushState("../" + sectionToShow, null, "../" + sectionToShow);
            evaluatePath(location.pathname);
        }

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
    //$(event.target).closest(".nav-buttons-wrapper").siblings().removeClass("active").addClass("right-wall-topic-menu");
    //$(event.target).closest(".nav-buttons-wrapper").removeClass("right-wall-topic-menu").addClass("active");
});

// When you select a dashboard from a section ------------------------------------------------------------------------------------------------------------------------
$(document).on('click', 'li.dashboard-button a', function (event) {

    event.preventDefault();
    var src = $(event.target).attr('val');
    var url = event.originalEvent.srcElement.id;
    var loc = location.pathname;
    history.pushState(loc + "/" + url, null, loc + "/" + url);
    showDashboard(src);

});

function showDashboard(src) {
    var backButton = "<button type='button' id='back-button' class='btn btn-default'>Back</button>",
        refreshButton = "<button type='button' class='btn btn-default'>Refresh</button>";

    //Change the page around (very hacky, but had to be done)
    $('#page').attr('id', 'hidden-page');
    $('#header-wrapper').addClass('page');
    $("#menu").hide();
    $('#content').css({'background-color': '#333'});
    // Checks to see if the user is on a mobile device or tablet, then (on the first dashboard they load) will warn the user that they should 
    // switch their device to landscape mode since the dashboards look a lot better when the device is in that position
    if (windowwidth < tabletPixels) {
        if (!warned) {
            alert("If you are on a tablet or mobile phone, please turn it to landscape mode for better quality of dashboard. Please turn to landscape and hit the refresh button on the screen.");
            warned = true;
        }
    } else { // If the user is on a desktop machine or larger, then just load the dashboard without any warnings 
        $('#content').css({'padding-left': '0', 'padding-right': '0'});
    }

    // Show the div with iframe
    $("#cyfe-iframe").attr('src', src);
    $("#cyfe-display").show();
    $("#cyfe-display").before(backButton);
    //$("#cyfe-display").before(refreshButton);

}

// When you click the back button on a dashboard --------------------------------------------------------------------------------------------------------------------
$(document).on('click', '#back-button', function (event) {
    history.go(-1);
});

//on clicking the refresh button for the dashboard --------------------------------------------------------------------------------------------------------------
$(document).on('click', '#refresh-button', function () {
    document.getElementById("cyfe-iframe").src = document.getElementById("cyfe-iframe").src;
});

$(document).on("click", ".section-buttons", function (e) {

    var topic = e.target.parentElement.parentElement.parentElement.parentElement.id;
    var section = e.target.parentElement.nextSibling.id;

    if (e.target.attributes[5].value == "true") {
        var url = "../" + topic + "/" + section;
        history.pushState(url, null, url);
    }
    else {
        var url = "../../" + topic;
        history.pushState(url, null, url);
    }
});

//Evaluates the URL path to determine what to load in the page's javascript
//Takes in the path as a parameter
function evaluatePath(path) {

    //$("[aria-expanded='true']").attr("aria-expanded", "false");
    //Splits the path with '/' as a delimiter
    var newPath = path.split("/");

    if (newPath[0] == "https:") {
        return;
    }
    //If the length is 4, it is assumed that the format of the url is host/topic/section/dashboard
    //If the length is 3: host/topic/section
    //2: host/topic
    //1: index page
    //If the length is less than 1 or greater than 4, we show a 404 page because something's wrong.
    var pathToParse = newPath;
    if (newPath.length == 4) {
        var dashboard = pathToParse.pop();
        var section = pathToParse.pop();
        var topic = pathToParse.pop();
    } else if (newPath.length == 3) {
        var section = pathToParse.pop();
        var topic = pathToParse.pop();
    } else if (newPath.length == 2) {
        var topic = pathToParse.pop();
    }
    else if (newPath.length < 1 || newPath.length > 4) {
        show404();
        return;
    }

    //Then we try to look for the correct topic
    if (topic !== "" && topic !== ".." && topic !== 'login') {
        //If the topic ID is not found, we show a 404
        var topicId = document.getElementById(topic);
        if (topicId == null) {
            show404();
            return;
        } else {
            //Otherwise, we hide the div that shows when there are no topics visible,
            //We show the topic -- and we want to make active the correct topic button,
            //So we look for that and add the active class to it
            $('#no-topics').hide();

            var currentActiveSection = document.querySelector('[active-section-list="true"]');
            $(".nav-buttons-wrapper.active").removeClass("active");
            if (currentActiveSection != null) {
                //$(currentTopicName).removeClass("active");
                currentActiveSection.setAttribute('active-section-list', false);
                $(currentActiveSection).hide();
            }
            //$(document).find('[active-section-list]').hide();
            //$("#" + convertNameToId($(document).find(".active .topic-buttons").text())).hide(); // find the id of the list of sections to show
            //$(document).find(".active .topic-buttons").text();
            var newSectionToShow = topicId;
            topicId.setAttribute('active-section-list', true);
            $(topicId).show();
            var topicBtn = document.getElementsByClassName("nav-buttons btn topic-buttons " + topic);
            var topicWrapper = topicBtn[0].closest(".nav-buttons-wrapper");
            $(topicWrapper).addClass("active");
        }
    }

    //If the topic is correct/found/kosher, we assume that they would have hit a 404 otherwise by now
    //So we look for the correct section next
    if (section !== undefined && section !== 'verifylogin') {
        var sect = $("#" + section, $(topicId));
        var sectionId = sect.attr("id");
        if (sectionId === undefined) {
            show404();
            return;
        } else {
            $("#" + sectionId).collapse("show");
        }
    }

    //If the section was correct, we look for the appropriate dashboard.
    //Here, we have a much higher possibility of duplicates, so we have to look for the dashboard
    //in the context of the section. We get the correct dashboard, get the correct value (another URL)
    //then we call the showDashboard function with the appropriate url/val.
    if (dashboard !== undefined) {
        var dash = $("#" + dashboard, $("#" + sectionId));
        var val = dash.attr('val');
        if (val == null) {
            show404();
        } else {
            showDashboard(val);
        }
    }

}

// converts the given string into a format used for classes and IDs ----------------------------------------------------------------------------------------------
function convertNameToId(inputText) {
    var $lowerCase = inputText.toLowerCase(),
        output = $lowerCase.replace(/(\s)+/g, '-');

    return output;
}

//Shows a 404 Div. Changes the innerHTML for the #content div to make it display a 404 not found message
function show404() {
    $("#content").css({
        'text-align': 'center'
    });
    $("#content").html("<h1>We were unable to locate that dashboard.</h1>");
    var homeBtn = "<button type='button' class='btn btn-default' onclick='goToHome()'>Return Home</button>";
    $("#content").append(homeBtn);
}

//Function to add a go-home functionality to any home button we may want to add
function goToHome() {
    window.location = '/';
}

function hide_dashboard() {
    // Undo all of the changes made to the page when a dashboard was initially selected.  Puts the page to its former build
    $('#back-button, #refresh-button').remove();
    $("#cyfe-display").hide();
    $("#menu").css('display', 'block');
    $("#cyfe-iframe").attr('src', '');
    $('#content').css({ 'background-color': '#fff', 'padding-top': 'none' });

    if (windowwidth >= mobilePixels) {
        $('#content').css({ 'padding-left': '', 'padding-right': '' });
    }

    //var url = location.pathname;
    //var newLoc = url.split("/");
    //newLoc.pop();
    //var newLoc = newLoc.join('/');
    //history.pushState(newLoc, null, newLoc);

    //Change the page back to normal template
    $('#hidden-page').attr('id', 'page');
    $('#header-wrapper').removeClass('page');
}
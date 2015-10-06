/*
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

/* 
 * When you select a section from the menu...
 * 
 * TO CHANGE: After data is loaded dynamically, populate each section, DO NOT erase the data, just show/hide all of the data instead.  Will make it much faster
 */
$(document).on('click', '.btn.nav-buttons.section-buttons', function (event) {
    // Dummy data to be appended and act like the dynamic data that we will use in the end
    // TO CHANGE: Will remove dummy data after data is loaded dynamically 
    var html = "<ul class='nav nav-pills nav-stacked dashboards'>"+
                    "<li role='presentation' class='dashboard-button'><a href='#'>This one</a></li>"+
                    "<li role='presentation' class='dashboard-button'><a href='#'>That one</a></li>" +
                    "<li role='presentation' class='dashboard-button'><a href='#'>Those ones</a></li>" +
                    "<li role='presentation' class='dashboard-button'><a href='#'>These ones</a></li>" +
                "</ul>";

    // TO CHANGE: Remove this after data is loaded dynamically, since it will just be showing what is already there, NOTTTT appending it 
    $(event.target).closest('.nav-buttons-wrapper').find('.section-buttons').nextAll().remove();

    // Append the dummy data to the current section, (accordion style) and hide any dashboards that are open in other sections
    $(event.target).closest('.nav-buttons-wrapper').append(html);
    $(event.target).closest('.nav-buttons-wrapper').siblings().find('a').nextAll().remove();

    // Moves some bottom borders around just for styling purposes, this is so the dashboards appear to belong in the currently selected section
    $(event.target).closest('.nav-buttons-wrapper').css('border-bottom', '1px solid #979797');
    $(event.target).css('border-bottom', 'none');
    $(event.target).closest('.nav-buttons-wrapper').siblings().css('border-bottom', 'none');
    $(event.target).closest('.nav-buttons-wrapper').siblings().find('a.section-buttons').css('border-bottom', '1px solid #979797');
});

$(document).on('click', 'li .dashboard-button', function () {
    var backButton = "<button type='button' id='back-button'>Back</button>";
    /*$.ajax({
        type: "GET",
        url: "Services/GetDashboard.php?id=1&mode=",
        dataType: 'html',
        success: function (msg) {*/
            //$('#content').css('background-color', 'transparent');
            $("#cyfe-iframe").attr('src', 'https://app.cyfe.com/dashboards/682/4f1e480ccb8cf101202552286564');
            $("#menu-nav").hide();
            $("#header").before(backButton);
            $("#cyfe-display").fadeIn();

            //Change the page around
            $('#page').attr('id', 'hidden-page');
            //$('#logout').addClass('page');
            $('#header-wrapper').addClass('page');
        //}
    //});
});

$(document).on('click', '#back-button', function () {
    //$('#content').css('background-color', '#fff');
    $('#back-button').remove();
    $("#cyfe-display").hide();
    $("#menu-nav").show();
    $("#cyfe-iframe").attr('src', '');

    //Change the page back to normal template
    $('#hidden-page').attr('id', 'page');
    $('#logout').removeClass('page');
    $('#header-wrapper').removeClass('page');
});
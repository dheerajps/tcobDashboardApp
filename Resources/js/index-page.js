// When you select a topic from the menu
$(document).on('click', ".btn.topic-buttons.nav-buttons", function (event) {
    // One variable will measure the position from the top of the page to the div, and one measures
    // from the currently selected topic to the top of its div (confusing but it works, don't question it)  :)
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
        $('.dashboard-sections-wrapper').show();
    }

    // Fade the content of the section names in 
    $('.dashboard-sections').fadeIn();

    //Position the sections-list div to the right vertical height to match the selected topic
    $('#sections-list').css('margin-top', (topPosition-topOffset));
});

/* 
 * When you select a section from the menu...
 */
$(document).on('click', '.btn.nav-buttons.section-buttons', function (event) {
    // Dummy data to be appended and act like the dynamic data that we will use in the end
    var html = "<ul class='nav nav-pills nav-stacked dashboards'>"+
                    "<li role='presentation'><a href='#'>This one</a></li>"+
                    "<li role='presentation'><a href='#'>That one</a></li>"+
                    "<li role='presentation'><a href='#'>Those ones</a></li>"+
                    "<li role='presentation'><a href='#'>These ones</a></li>"+
                "</ul>";
    // Append the dummy data to the current section, (accordion style) and hide any dashboards that are open in other sections
    $(event.target).closest('.nav-buttons-wrapper').append(html);
    $(event.target).closest('.nav-buttons-wrapper').siblings().find('a').nextAll().remove();

    // Moves some bottom borders around just for styling purposes, this is so the dashboards appear to belong in the currently selected section
    $(event.target).closest('.nav-buttons-wrapper').css('border-bottom', '1px solid #979797');
    $(event.target).css('border-bottom', 'none');
    $(event.target).closest('.nav-buttons-wrapper').siblings().css('border-bottom', 'none');
    $(event.target).closest('.nav-buttons-wrapper').siblings().find('a.section-buttons').css('border-bottom', '1px solid #979797');
    $('.dashboards').show();
});
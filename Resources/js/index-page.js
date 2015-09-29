// When you select a topic from the menu
$(document).on('click', ".btn.topic-buttons.nav-buttons", function (event) {
    $(event.target).closest(".nav-buttons-wrapper").addClass("active");
    $(event.target).closest(".nav-buttons-wrapper").removeClass("right-wall-topic-menu");
    $(event.target).closest(".nav-buttons-wrapper").siblings().removeClass("active");
    $(event.target).closest(".nav-buttons-wrapper").siblings().addClass("right-wall-topic-menu");
    if ( $('#dashboard-sections-wrapper').is(':hidden') ) {
        $('#no-topics').hide();
        $('#dashboard-sections-wrapper').show();
        $('#dashboard-sections').fadeIn();
    }
});
$(document).on('click', ".btn.nav-buttons", function (event) {
    $(event.target).closest(".nav-buttons-wrapper").addClass("active");
    $(event.target).closest(".nav-buttons-wrapper").siblings().removeClass("active");
});
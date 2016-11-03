$(document).ajaxStart(function () {
    $("#loading").css("display", "block");
});

$(document).ajaxStop(function () {
    $("#loading").css("display", "none");
});

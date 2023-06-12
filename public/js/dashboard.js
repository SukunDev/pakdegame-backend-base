toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};

var x, y, top, left, down;
var resultMassShrinker = "";

$("#scrollable-card").mousedown(function (e) {
    e.preventDefault();
    down = true;
    x = e.pageX;
    y = e.pageY;
    top = $(this).scrollTop();
    left = $(this).scrollLeft();
});

$("body").mousemove(function (e) {
    if (down) {
        var newX = e.pageX;
        var newY = e.pageY;

        $("#scrollable-card").scrollTop(top - newY + y);
        $("#scrollable-card").scrollLeft(left - newX + x);
    }
});

$("body").mouseup(function (e) {
    down = false;
});

$(document).ready(function () {
    $(".sidebar-dropdown").on("click", function () {
        var dropdown = $(this).parent();
        var dropdown_content = dropdown.find(".dropdown-content");
        dropdown_content.animate({ height: "toggle" }, 500);
        if (dropdown_content.attr("aria-expanded") === "true") {
            dropdown.find(".dropdown-arrow").css({ transform: "rotate(0deg)" });
            dropdown_content.attr("aria-expanded", false);
            return;
        }
        dropdown.find(".dropdown-arrow").css({ transform: "rotate(180deg)" });
        dropdown_content.attr("aria-expanded", true);
    });
    $(".title-hover").hover(
        function () {
            $(this).find(".item-hover").animate({
                opacity: 1,
            });
        },
        function () {
            $(this).find(".item-hover").animate({
                opacity: 0,
            });
        }
    );
    $("#tambahButtonKategori").on("click", function () {
        $("#kategoriPanel").animate(
            {
                height: "toggle",
            },
            300
        );
    });
});

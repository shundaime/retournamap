"use strict";
window.onload = function () {

function ScrollToTop() {
    var s = $(window).scrollTop();
    if (s > 400) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }

    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
        return false;
    });
}

function StopAnimation() {
    $("html, body").bind("scroll mousedown DOMMouseScroll mousewheel keyup", function () {
        $('html, body').stop();
    });
}

$(window).scroll(function () {
    ScrollToTop();
    StopAnimation();
});

    var div = document.getElementById('scroll');
    div.scrollTop = div.scrollHeight; //Fait descendre le scroll à son niveau maximum
};

$(document).ready(function () {

});









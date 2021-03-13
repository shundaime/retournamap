"use strict";
/*$(window).on('load', function () {
    $('#overlay').fadeOut('1500');
});*/

$(document).ready(function () {

    let div = $('#scroll');
    if (div) {
        div.scrollTop = div.scrollHeight; //Fait descendre le scroll à son niveau maximum
    }

    $(window).scroll(function () {
        ScrollToTop();
        StopAnimation();
    });

    //Dynamic reveal
    const ratio = .1;
    const options = {
        root : null,
        rootMargin: '0px',
        threshold: ratio
    };

    const handleIntersect = function (entries, observer) {
        entries.forEach(function (entry) {
            if(entry.intersectionRatio > ratio){
                entry.target.classList.remove('reveal');
                observer.unobserve(entry.target)
            }
        })
    };

    document.documentElement.classList.add('reveal-loaded');
    const observer = new IntersectionObserver(handleIntersect, options);
    document.querySelectorAll('.reveal').forEach(function (r) {
        observer.observe(r)
    });

    $(document).on('change', '.custom-file-input', function () {
        let fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
        $(this).parent('.custom-file').find('.custom-file-label').text(fileName);
    });

    $("nav a").on("click", function () {

        let href = $(this).attr("href");

        window.history.pushState(null, null, href);

        $.ajax({
            url:href,
            success: function (data) {
                let main = $('main');
                main.fadeOut(250, function () {
                    let newPage = $(data).filter("main").html();

                    main.html(newPage);

                    main.fadeIn(250)
                })
            }
        })
    });
});

function ScrollToTop() {
    let s = $(window).scrollTop();
    let scrollUp = $('.scroll-up');
    s > 400 ? scrollUp.fadeIn() : scrollUp.fadeOut(); //Ternaire

    scrollUp.click(function() {
        $("html, body").animate({scrollTop: 0}, 500);
        return false;
    });
}

function StopAnimation() {
    $("html, body").bind("scroll mousedown DOMMouseScroll mousewheel keyup", function () {
        $('html, body').stop();
    });
}









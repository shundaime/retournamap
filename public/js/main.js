"use strict";

$(document).ready(function () {

    let div = $('#scroll');
    if (div) {
        div.scrollTop = div.scrollHeight; //Fait descendre le scroll à son niveau maximum
    }

    $(window).scroll(function () {
        ScrollToTop();
        StopAnimation();
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

    var el = document.createElement('script');
    el.setAttribute('src', 'https://static.axept.io/sdk.js');
    el.setAttribute('type', 'text/javascript');
    el.setAttribute('async', true);
    el.setAttribute('data-id', '5d6e35970f29990e81b9757f');
    if (document.body !== null) {
        document.body.appendChild(el);
    }
});
'use strict';

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

    $('nav a').on('click', function () {
        let href = $(this).attr('href');

        window.history.pushState(null, null, href);

        $.ajax({
            url: href,
            success: function (data) {
                let main = $('main');
                main.fadeOut(250, function () {
                    let newPage = $(data).filter('main').html();

                    main.html(newPage);

                    main.fadeIn(250);
                });
            },
        });
    });

    function ScrollToTop() {
        let s = $(window).scrollTop();
        let scrollUp = $('.scroll-up');
        s > 400 ? scrollUp.fadeIn() : scrollUp.fadeOut(); //Ternaire

        scrollUp.click(function () {
            $('html, body').animate({ scrollTop: 0 }, 500);
            return false;
        });
    }

    function StopAnimation() {
        $('html, body').bind('scroll mousedown DOMMouseScroll mousewheel keyup', function () {
            $('html, body').stop();
        });
    }

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'listMonth',
        validRange: function (nowDate) {
            return {
                start: nowDate,
            };
        },
        headerToolbar: {
            start: 'title',
            center: '',
            end: 'prev,next',
        },
        locale: 'fr',
        hiddenDays: [0, 1, 2, 3, 5, 6],
        contentHeight: 'auto',
        googleCalendarApiKey: 'AIzaSyAKZpXXPUym7vIEDQbCdjr_NJ2uvs6RZAk',
        events: {
            googleCalendarId: 'retournamap@gmail.com',
        },
        views: {
            dayGridMonth: {
                displayEventEnd: true,
                titleFormat: { month: 'long' },
            },
        },
        eventTimeFormat: {
            // like '14:30'
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false,
        },
        eventClick: function (info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate
            if (info.event.url) {
                window.open(info.event.url);
            }
        },
        eventDidMount: function (info) {
            console.log(info.event.extendedProps.attachments[0]);
            var tooltip = new Tooltip(info.el, {
                title: info.event.extendedProps.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body',
            });
        },
        eventColor: '#f29400',
    });
    calendar.render();
});

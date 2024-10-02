$(document).ready(() => {
    if (typeof $ !== 'undefined' && typeof $ !== null) {
        const scrollToTop = () => {
            const scrollUp = $('.scroll-up');
            const s = $(window).scrollTop();

            if (s > 400) {
                scrollUp.fadeIn();
            } else {
                scrollUp.fadeOut();
            }

            scrollUp.on('click', () => {
                $('html, body').animate({ scrollTop: 0 }, 500);
                return false;
            });
        };

        const stopAnimation = () => {
            $('html, body').on('scroll mousedown DOMMouseScroll mousewheel keyup', () => {
                $('html, body').stop();
            });
        };

        const loadCalendar = () => {
            const calendarEl = document.getElementById('calendar');

            if (calendarEl) {
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'listMonth',
                    validRange: (nowDate) => ({
                        start: nowDate,
                    }),
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
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: false,
                    },
                    eventClick: (info) => {
                        info.jsEvent.preventDefault();

                        if (info.event.url) {
                            window.open(info.event.url);
                        }
                    },
                    eventDidMount: (info) => {
                        const tooltip = new Tooltip(info.el, {
                            title: info.event.extendedProps.description,
                            placement: 'top',
                            trigger: 'hover',
                            container: 'body',
                        });
                    },
                    eventColor: '#f29400',
                });

                calendar.render();
            }
        };

        const loadScrollTop = () => {
            const div = $('#scroll');

            if (div) {
                div.scrollTop(div.scrollHeight);
            }
        };

        const loadFileInput = () => {
            $(document).on('change', '.custom-file-input', (e) => {
                const fileName = e.target.value.replace(/\\/g, '/').replace(/.*\//, '');
                $(e.target).parent('.custom-file').find('.custom-file-label').text(fileName);
            });
        };

        const loadNav = () => {
            $('nav a').on('click', (e) => {
                e.preventDefault();
                const target = $(e.target);
                const href = target.attr('href');

                window.history.pushState(null, null, href);

                $('nav a').removeClass('active');
                target.addClass('active');

                $.ajax({
                    url: href,
                    success: (data) => {
                        const main = $('main');

                        main.fadeOut(250, () => {
                            const newPage = $(data).filter('main').html();

                            main.html(newPage);

                            main.fadeIn(250);

                            loadCalendar();
                        });
                    },
                });
            });
        };

        loadScrollTop();
        loadFileInput();
        loadCalendar();
        loadNav();

        $(window).scroll(() => {
            scrollToTop();
            stopAnimation();
        });
    }
});

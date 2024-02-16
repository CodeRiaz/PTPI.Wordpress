jQuery(document).ready(function ($) {
    let $window = $(window);
    let $body = $('body');

    $window.on('scroll', function () {
        if ($(window).scrollTop() > 77) {
            $('.header').addClass('scrolled');
        } else {
            $('.header').removeClass('scrolled');
        }
    })

    $('#hamburger').click(function () {
        $(this).toggleClass('open');
        $('.menu__wrapper').toggleClass('active');
        $('body').toggleClass('menu-opened');
    });

    $('.tabs_section__column--slider').on('afterChange', function (evt, slick, currentSlide) {
        $(this).next().find('li').removeClass('active').eq(currentSlide).addClass('active');
        // console.log(currentSlide);
    })

    $('.tabs_section__list:not(.no-js) li a').on('click', function (evt) {
        evt.preventDefault()
        $(this).parent().addClass('active').siblings('.active').removeClass('active');
        $('.tabs_section__column--slider').slick('slickGoTo', parseInt($(this).parent().data('index')) - 1);
    })

    $('.tabs_section__column--slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        dots: false,
        loop: true,
        autoPlay: true,
        adaptiveHeight: true
    })

    $('.slick-int').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        dots: false,
        loop: true,
        adaptiveHeight: true
    })

    $('.conference-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        adaptiveHeight: true,
        asNavFor: '.slider-thumb'
    })

    $('.previous-conference-name').on('click', function (evt) {
        evt.preventDefault();

        let $this = $(this);

        $this.closest('ul').find('li').removeClass('active');
        $this.parent().addClass('active');

        $('.conference-slider').slick('slickUnfilter');
        $('.conference-slider').slick('slickFilter', '.' + $this.data('filter'));

        $('.slider-thumb.slick-initialized').slick('unslick');
        // $('.slider-thumb').slick('slickUnfilter');
        // $('.slider-thumb').slick('slickFilter', '.' + $this.data('filter'));

        $('.slider-thumb').slick({
            slide: '.' + $this.data('filter'),
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.conference-slider',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            arrows: false,
            infinite: false
        });

        // $('.conference-slider').slick('slickGoTo', 0);
        // $('.slider-thumb').slick('slickGoTo', 0);
    });

    $('.previous-conference-name').first().click();

    // Play/Pause support for videos without controls
    $('video:not([controls])').on('click', function (evt) {
        console.log('video click')
        if (this.paused) {
            this.play()
        } else {
            this.pause()
        }
    })

    // CountUp numbers
    $('.countup').each(function (index, elem) {
        var $elem = $(elem);
        var demo = null;
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
        };

        if ($elem.data('prefix').length) {
            options['prefix'] = $elem.data('prefix')
        }

        if ($elem.data('suffix').length) {
            options['suffix'] = $elem.data('suffix')
        }

        demo = new CountUp($elem.attr('id'), 0, parseInt($elem.data('number')), 0, 2.5, options);

        if (!demo.error) {
            demo.start();
        } else {
            console.error(demo.error);
        }
    });

    // Days toggle, on Trip Details page
    $('.itinerary-content .days li a').on('click', function (e) {
        e.preventDefault();

        let $this = $(this);
        let $days = $this.closest('.days');
        let $hotels = $days.closest('.itinerary-content').next('.hotel-detail');
        let day = $this.text().trim();
        let $active = $('.itinerary-content .days li.active');

        if ($this == $active) {
            return false;
        }

        $active.removeClass('active');
        $this.parent().addClass('active');

        $days.siblings('.active').removeClass('active');
        $days.siblings('.day-' + day).addClass('active');

        $hotels.find('.active').removeClass('active');
        $hotels.find('.day-' + day).addClass('active');
    });

    $('.maural-slider-wrapper').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        autoplay: true,
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
              }
            },
            {
              breakpoint: 577,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              }
            }
          ]
    });

    $('.slider_wrapper').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        autoplay: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 350,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $('#accordion .accordion-toggle, .accordion .accordion-toggle').click(function () {
        //Expand or collapse this panel
        $(this).next().slideToggle('fast');

        //Hide the other panels
        $(".accordion-content").not($(this).next()).slideUp('fast');
    });

    $('.questions-pagination li a').on('click', function(e) {
        e.preventDefault();
        let $this = $(this);

        $('.questions-blocks-wrapper .questions-block:visible').fadeOut(250, function() {
            $('.questions-blocks-wrapper .questions-block').eq(parseInt($this.text()) - 1).fadeIn(250)
        });

        $this.addClass('active').parent().siblings().find('a').removeClass('active');
    })

    $('#map-country-input').on('change', function() {
        if (this.value != -1) {
            window.location = this.dataset.permalink + '?country=' + this.value;
        }
    });

    $('#map-chapter-input').on('change', function() {
        if (this.value != -1) {
            window.location = '/chapter?chapter_id=' + this.value;
        }
    });
})

function initMap() {

    if (!document.getElementById('map')) {
        return false;
    }

    var chapters = window.chapters;

    if (!chapters || !chapters.length) {
        return false;
    }

    var mapElem = document.getElementById('map');

    var map = new google.maps.Map(mapElem, {
        // zoom: 3,
        zoom: parseInt(mapElem.dataset.zoom),
        // center: new google.maps.LatLng(window.chapters[0].lat, window.chapters[0].lng),
        center: new google.maps.LatLng(parseFloat(mapElem.dataset.lat), parseFloat(mapElem.dataset.lng)),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [{
                "featureType": "all",
                "elementType": "all",
                "stylers": [{
                        "saturation": "32"
                    },
                    {
                        "lightness": "-3"
                    },
                    {
                        "visibility": "on"
                    },
                    {
                        "weight": "1.18"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "landscape",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "all",
                "stylers": [{
                        "saturation": "-70"
                    },
                    {
                        "lightness": "14"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "transit",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{
                        "saturation": "100"
                    },
                    {
                        "lightness": "-14"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels",
                "stylers": [{
                        "visibility": "off"
                    },
                    {
                        "lightness": "12"
                    }
                ]
            }
        ]

    });

    var infoWindow = new google.maps.InfoWindow();
    var marker, i;

    for (i = 0; i < chapters.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(chapters[i].lat, chapters[i].lng),
            map: map,
            label: '',
            icon: {
                url: '/wp-content/themes/ptpi/assets/images/pin.svg',
                scaledSize: new google.maps.Size(30, 30),
                // origin: new google.maps.Point(0, 0),
                // anchor: new google.maps.Point(0,0),
                labelOrigin: new google.maps.Point(15, 40)
            }
            // origin: new google.maps.Point(0, 0),
            // anchor: new google.maps.Point(32,65),
            // labelOrigin: new google.maps.Point(40,1000)
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                // infoWindow.setContent(chapters[i].content);
                // infoWindow.open(map, marker);
                window.location = '/chapter?chapter_id=' + chapters[i]['id']
            }
        })(marker, i));
    }
}
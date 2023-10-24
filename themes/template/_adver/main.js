$(function() {

    $('.main-nav .navbar-toggler').click(function() {
        $('.navbar-collapse.mobile').addClass('active');
        $('.overlay-mobile').addClass('show');
    });

    $('.overlay-mobile').click(function() {
        $('.navbar-collapse.mobile').removeClass('active');
        $('.overlay-mobile').removeClass('show');
    });


    $('.menu-right i.fa-search').click(function() {

        $('form.search').slideToggle(500);

    });


    $('.product-category .item button').click(function() {
        $('.item').removeClass('active');
        var parent = $(this).parent();
        parent.addClass('active');

        $('.item.active').find('.child-category').slideToggle();
        $(this).find('i').toggleClass('active');

        $('.child-category').slideDown();

    });

    $('.counter').each(function() {
        var count = $(this),
            countTo = count.attr('data-count');

        $({ countNum: count.text() }).animate({
                countNum: countTo
            },

            {
                duration: 8000,
                easing: 'linear',
                step: function() {
                    count.text(Math.floor(this.countNum));
                },
                complete: function() {
                    count.text(this.countNum);
                    //alert('finished');
                }
            });

    });

    $('.paginations a.item').click(function() {

        $('.paginations a.item').removeClass('curent');
        $(this).addClass('curent');

    });



    $('.star.selected a').click(function(e) {
        e.preventDefault();

        $('.star.selected a').removeClass('active');
        $(this).addClass('active');

    });


    // var w = $(window).width();

    // if (w >= 1024) {

    //     $('.navbar-nav li').hover(function() {

    //         $(this).find('ul:first').slideToggle(200);

    //     });

    // } else if (w <= 989) {

        $('.btn-dropmenu').click(function(event) {
            event.preventDefault();

            $(this).parent().find('ul:first').slideToggle();

        });

    // }


    // Slide prduct

    var swiper = new Swiper(".gallery-2", {
        speed: 1000,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: ".swiper-button-next.gallery",
            prevEl: ".swiper-button-prev.gallery2",
        }
    });
    var swiper2 = new Swiper(".gallery-1", {
        loop: true,
        speed: 1000,
        spaceBetween: 10,
        thumbs: {
            swiper: swiper,
        },
    });


    //Partner
    var swiper = new Swiper(".partner", {

        slidesPerView: 6,
        spaceBetween: 30,

        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        speed: 1000,
        loop: true,

        navigation: {
            nextEl: ".swiper-button-next.partner",
            prevEl: ".swiper-button-prev.partner",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
        },
    });

    nút tăng giảm Số lượng sản phẩm
    $('input.input-qty').each(function() {

        var $this = $(this);
        qty = $this.parent().find('.is-form');
        min = Number($this.attr('min'));
        max = Number($this.attr('max'));
        if (min == 0) {
            var d = 0;
        } else
            d = min;
        $(qty).on('click', function() {
            if ($(this).hasClass('minus')) {
                if (d > min) d += -1;
            } else if ($(this).hasClass('plus')) {
                var x = Number($this.val()) + 1;
                if (x <= max) d += 1;
            }
            $this.attr('value', d).val(d);
        });
    });



});

var second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

var elem = document.getElementById('countdown');

var count = elem.getAttribute('data-count');

countDown = new Date(count).getTime(),
    x = setInterval(function() {

        var now = new Date().getTime(),
            distance = countDown - now;

        if (distance / (day) < 0) {
            document.getElementById("days").innerText = 0;
        } else {
            if (distance / (day) < 10) {
                document.getElementById("days").innerText = "0" + Math.floor(distance / (day));
            } else {
                document.getElementById("days").innerText = Math.floor(distance / (day));
            }

        }
        if (distance / (hour) < 0) {
            document.getElementById("hours").innerText = 0;
        } else {
            document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour));
        }

        if (distance / (minute) < 0) {
            document.getElementById("minutes").innerText = 0;
        } else {
            if (distance / (minute) < 10) {
                document.getElementById("days").innerText = "0" + Math.floor((distance % (hour)) / (minute));
            } else {
                document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute));
            }
        }
        if (distance / (second) < 0) {
            document.getElementById("seconds").innerText = 0;
        } else {
            if (distance / (second) < 10) {
                document.getElementById("days").innerText = "0" + Math.floor((distance % (minute)) / second);
            } else {
                document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
            }
        }

    }, 0);



    
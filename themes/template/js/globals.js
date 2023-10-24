$(function () {
  if ($(window).width() >= 1200) return;

  $(".js-course-intro-tab").on("shown.bs.tab", function () {
    var target = $(this).attr("href");

    sessionStorage.activeTab = target;
  });

  if (sessionStorage.activeTab) {
    var $tabBtn = $(`.js-course-intro-tab[href="${sessionStorage.activeTab}"]`);

    $tabBtn.trigger("click");
  }
});

$(function () {
  $(".md-login").on("hidden.bs.modal", function () {
    $(".js-login-alert-box").addClass("d-none");
  });

  if ($(".js-login-required").length) {
    $(".js-login-alert-box").removeClass("d-none");
    $(".md-login").modal("show");
  } else if ($(".js-purchase-required").length) {
    $(".md-purchase-require").modal("show");

    $(".js-md-purchase-btn").on("click", function (e) {
      e.preventDefault();
      $(".md-purchase-require").modal("hide");

      var $tabs = $(".n-tabs");

      if (!$tabs.length) return;

      $("html, body").animate({
        scrollTop: $tabs.offset().top - $(".header__sticky").outerHeight()
      }, 400);

      $tabs.find(".nav-item:nth-child(2) .nav-link").trigger("click");
    });
  }
});

$(document).ready(function () {
  if (!sessionStorage.firstVisit) {
    $(".md-welcome").modal("show");
    sessionStorage.firstVisit = true;
  }

  $(".js-restore-btn").on("click", function (e) {
    e.preventDefault();
    $(".md-login").modal("hide");
    setTimeout(function () {
      $(".md-restore").modal("show");
    }, 300);
  });

  $(".menu__dropdown").children(".menu__link").on("click", function (e) {
    e.preventDefault();
    $(this).siblings(".menu__sub").slideToggle();
  });

  $(".js-dropdown-toggle").on("click", function (e) {
    e.preventDefault();
    $(this).parent().siblings(".js-dropdown-menu").slideToggle();
  });

  $(".navbar-mobile-btn").on("click", function () {
    $(".navbar-mobile, .navbar-backdrop").addClass("is-show");
    $("body").addClass("over-hidden");
  });
  $(".navbar-backdrop, .navbar-mobile-close, .navbar-close").on("click", function () {
    $(".navbar-mobile, .navbar-backdrop").removeClass("is-show");
    $("body").removeClass("over-hidden");
  });

  // move top button
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 200) {
      $(".btn-movetop").fadeIn(500);
    } else {
      $(".btn-movetop").fadeOut(500);
    }
  });
  $(".btn-movetop").on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({
      scrollTop: 0
    }, 800);
  });

  $(".js-subject-slider").each(function () {
    var sliderEl = $(this).find(".swiper-container").get(0);
    var prevEl = $(this).find(".subject-slider__prev").get(0);
    var nextEl = $(this).find(".subject-slider__next").get(0);
    new Swiper(sliderEl, {
      slidesPerView: 4,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 2000
      },
      speed: 1000,
      breakpoints: {
        992: {
          slidesPerView: 3
        },
        768: {
          slidesPerView: 2
        },
        576: {
          slidesPerView: 2,
          spaceBetween: 10
        }
      },
      navigation: {
        prevEl,
        nextEl
      }
    });
  });

  $(".experience-slider").each(function () {
    var $container = $(this),
        $sliderEl = $container.find(".swiper-container"),
        $prevEl = $container.find(".experience-slider__prev"),
        $nextEl = $container.find(".experience-slider__next");

    new Swiper($sliderEl, {
      slidesPerView: 5,
      loop: true,
      autoplay: {
        delay: 2500
      },
      speed: 500,
      navigation: {
        prevEl: $prevEl,
        nextEl: $nextEl
      },
      breakpoints: {
        992: {
          slidesPerView: 4
        },
        768: {
          slidesPerView: 3
        },
        576: {
          slidesPerView: 2
        }
      }
    });
  });

  // incentives countdown
  if ($("#js-deadline").length) {
    const deadline = $("#js-deadline").data("deadline");
    initialClock("js-deadline", deadline);
  }

  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 150) {
      $(".header__sticky").addClass("is-stick");
    } else {
      $(".header__sticky").removeClass("is-stick");
    }
  });

  floating();
});

function initialClock(id, endtime) {
  var clock = document.getElementById(id);
  if (!clock) {
    return;
  }
  var timeinterval = setInterval(function () {
    var t = getTimeRemaining(endtime);
    clock.innerHTML = `
<div>
  <span>${t.days}</span>
  <span>Ngày</span>
</div>
<div>
  <span>${t.hours}</span>
  <span>Giờ</span>
</div>
<div>
  <span>${t.minutes}</span>
  <span>Phút</span>
</div>
<div>
  <span>${t.seconds}</span>
  <span>Giây</span>
</div>
    `;
    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }, 1000);
}

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  if (t < 0) return {
    total: 0,
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0
  };
  var seconds = Math.floor(t / 1000 % 60);
  var minutes = Math.floor(t / 1000 / 60 % 60);
  var hours = Math.floor(t / (1000 * 60 * 60) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  if (days > 99) {
    days = 99;
  }
  return {
    total: t,
    days: days,
    hours: hours,
    minutes: minutes,
    seconds: seconds
  };
}

$(window).on("load", function () {
  setTimeout(function () {
    $(".js-social-sticky").addClass("is-show");
  }, 500);
});

$(document).ready(function () {
  $(".js-thumb-input").on("change", function () {
    var input = $(this).get(0);
    var image = $(".js-thumb-img");
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        image.attr("src", e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  });
});

function floating() {
  $(".floating").each(function () {
    var width = $(this).width();
    var offsetLeft = $(this).offset().left;
    var offsetTop = $(this).offset().top;
    $(this).data("offsetLeft", offsetLeft);
    $(this).data("offsetTop", offsetTop);
    $(this).css({
      width: width
    });
  });

  if ($(window).width() < 992) {
    return;
  }

  $(window).on("scroll", function () {
    $(".floating").each(function () {
      var top = 20;
      var scrollTop = $(window).scrollTop();
      var offsetTop = $(this).data("offsetTop");
      var offsetLeft = $(this).data("offsetLeft");
      var height = $(this).outerHeight();
      var outerHeight = $(this).outerHeight(true);
      var container = $(this).closest(".floating-container");
      var containerWidth = $(container).innerWidth() - 30;
      var containerHeight = $(container).outerHeight();
      var containerOffsetTop = $(container).offset().top;
      var containerOffsetLeft = $(container).offset().left;

      if (outerHeight + offsetTop == containerHeight + containerOffsetTop) {
        return;
      } else if (scrollTop + top <= offsetTop) {
        $(this).css({
          position: "static"
        });
      } else if (scrollTop + height + top > containerHeight + containerOffsetTop) {
        $(this).css({
          width: containerWidth,
          position: "absolute",
          zIndex: 2,
          top: "auto",
          bottom: 0,
          left: "15px"
        });
      } else {
        $(this).css({
          width: containerWidth,
          position: "fixed",
          zIndex: 2,
          top: top,
          left: containerOffsetLeft + 15,
          bottom: "auto"
        });
      }
    });
  });
}

// payment switch currency
$(function () {
  $(".js-account-select").on("change", function () {
    var currency = $(".js-account-select:checked").data("currency");

    if (currency == "vn") {
      $(".js-currency-vn").show();
      $(".js-currency-jp").hide();
    } else if (currency == "jp") {
      $(".js-currency-vn").hide();
      $(".js-currency-jp").show();
    } else {
      $(".js-currency-vn").hide();
      $(".js-currency-jp").hide();
    }
  });
});

// swiper template
function addSwiper(selector, options = {}) {
  return Array.from(document.querySelectorAll(selector), function (item) {
    var $sliderContainer = $(item),
        $sliderEl = $sliderContainer.find(selector + "__container");

    if (options.navigation) {
      $sliderContainer.addClass("has-nav");
      options.navigation = {
        prevEl: $sliderContainer.find(selector + "__prev"),
        nextEl: $sliderContainer.find(selector + "__next")
      };
    }

    if (options.pagination) {
      $sliderContainer.addClass("has-pagination");
      options.pagination = {
        el: $sliderContainer.find(selector + "__pagination"),
        clickable: true
      };
    }

    return new Swiper($sliderEl, options);
  });
}

// course slider
$(function () {
  const sliders = addSwiper(".course-slider", {
    slidesPerView: 4,
    speed: 400,
    navigation: true,
    breakpoints: {
      1200: {
        slidesPerView: 3
      },
      991: {
        slidesPerView: 2
      },
      767: {
        slidesPerView: 1.5
      },
      575: {
        slidesPerView: 1.3
      }
    }
  });

  if (!sliders) return;

  $(".n-tabs .nav-link").on("shown.bs.tab", () => {
    sliders.map(slider => slider.update());
  });
});

// Testimonail-slider
$(function () {
  addSwiper(".testimonial-slider", {
    loop: true,
    spaceBetween: 30,
    slidesPerView: 2,
    pagination: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false
    },
    breakpoints: {
      1199: {
        spaceBetween: 16
      },
      991: {
        slidesPerView: 1,
        spaceBetween: 16
      }
    }
  });
});

// teacher slider
$(function () {
  addSwiper(".teacher-slider", {
    slidesPerView: 3,
    autoplay: {
      delay: 3000
    },
    navigation: true,
    breakpoints: {
      992: {
        slidesPerView: 2
      },
      576: {
        slidesPerView: 1.3
      }
    }
  });
});

$(function () {
   var videoslider = addSwiper(".video-slider", {
    slidesPerView: 4,
    spaceBetween: 10,
    navigation: true
  });
  if ($(".video-slider__frame--active").length>0){
  var activeindex = $(".video-slider__frame--active").data("key");
  videoslider[0].slideToLoop( activeindex );
}
});

$(function () {
  addSwiper(".banner-slider", {
    speed: 700,
    loop: true,
    effect: "fade",
    autoplay: {
      delay: 6000,
      disableOnInteraction: false
    },
    breakpoints: {
      991: {
        autoHeight: true
      }
    }
  });
});

$(function () {
  $(".n-menu__link").on("click", function (e) {
    var $submenu = $(this).siblings(".n-menu__sub");

    if ($submenu.length) {
      e.preventDefault();

      $submenu.slideToggle();
    }
  });
});

$(function () {
  $(".h-nav__toggle").on("click", function (e) {
    e.preventDefault();
    $(".h-nav__dropdown").fadeToggle();
  });
});

$(function () {
  var token = true;

  $(".as-nav .nav-link").on("shown.bs.tab", function () {
    var target = $(this).attr("href");

    if (token) {
      token = false;

      $("html, body").animate({
        scrollTop: $(target).offset().top - $(".header__sticky").height() - 10
      }, 600);

      setTimeout(() => token = true, 600);
    }
  });
});

$(function () {
  $(".js-payment-method").on("change", function () {
    var target = $(this).find(":selected").data("target");

    if (target) {
      $(target).slideDown();
    }

    $(".js-payment-info").not($(target)).slideUp();
  });
});

$(function () {
  $(".expandable").each(function () {
    var $el = $(this);
    var $content = $el.find(".expandable__content");
    var $btn = $el.find(".expandable__toggle");
    var height = $el.data("height") || 300;

    if ($content.height() > height) {
      $el.css("height", height);
    } else {
      $el.addClass("show");
    }

    $btn.on("click", function (e) {
      e.preventDefault();

      var $toggle = $(this);
      var $el = $toggle.closest(".expandable");

      $el.toggleClass("expand");
    });
  });
});

$(function () {
  $(".js-float-sidebar-open").on("click", function () {
    var target = $(this).data("target");

    $(target).addClass("is-show");
  });

  $(".float-sidebar__close").on("click", function () {
    $(this).closest(".float-sidebar").removeClass("is-show");
  });
});


// thêm popup 2022 phuonghv
// common.js
$(function () {
  let rand = Math.random();
  let modal = rand > 0.5 ? ".md-video-1" : ".md-video-2";

  $(modal).modal("show");

  $(modal).on("hide.bs.modal", function () {
    $(this).find("iframe").attr("src", "");
  });
});
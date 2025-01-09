"use strict";

/*================
 Template Name: Hostlar Hosting Provider with WHMCS Template
 Description: All type of web hosting provider or company with WHMCS template.
 Version: 1.0
 Author: https://themeforest.net/user/themetags
=======================*/
// TABLE OF CONTENTS
// 1. preloader
// 2. mega menu js
// 3. fixed navbar
// 4. scroll bottom to top
// 5. custom vps hosting plan js
// 6. monthly and yearly pricing switch
// 7. tooltip
// 8. magnify popup video
// 9. hero slider one
// 10. hero slider two
// 11. client-testimonial carousel
// 12. client logo item carousel
// 13. team member carousel
// 14. video background
// 15. wow js
// 16. countdown or coming soon
// 17. sticky sidebar
// 18. chat api js
// 19. image gallery js
// 20. contact form js
jQuery(function ($) {
  'use strict'; // 1. preloader

  $(window).ready(function () {
    $('#preloader').delay(200).fadeOut('fade');
  }); // 2. mega menu js

  $('.js-mega-menu').HSMegaMenu({
    event: 'hover',
    pageContainer: $('.container'),
    breakpoint: 767.98,
    hideTimeOut: 0
  }); // 3. fixed navbar

  $(window).on('scroll', function () {
    // checks if window is scrolled more than 500px, adds/removes solid class
    if ($(this).scrollTop() > 100) {
      $('.main-header-menu-wrap').addClass('affix');
    } else {
      $('.main-header-menu-wrap').removeClass('affix');
    }
  }); // 4. scroll bottom to top

  $(window).on('scroll', function () {
    if ($(window).scrollTop() > $(window).height()) {
      $('.scroll-to-target').addClass('open');
    } else {
      $('.scroll-to-target').removeClass('open');
    }

    if ($('.scroll-to-target').length) {
      $(".scroll-to-target").on('click', function () {
        var target = $(this).attr('data-target');
        var new_time = new Date();

        if (!this.old_time || new_time - this.old_time > 1000) {
          // animate
          $('html, body').animate({
            scrollTop: $(target).offset().top
          }, 500);
          this.old_time = new_time;
        }
      });
    }
  }); // 5. custom vps hosting plan js
  //**************************** Need to change ********************
  // Change according to your plans
  //****************************************************************
  // vpsPlan      = VPS plan or package number
  // vpsCore      = VPS Core value from your plan
  // vpsMemory    = VPS Memory from your plan
  // vpsStorage   = VPS Storage value from your plan
  // vpsBandwidth = VPS bandwidth value from your plan
  // vpsPrice     = VPS price from your plan
  // vpsWHmcsUrl  = VPS plan url. Check from your WHMCS panel
  //****************************************************************

  var vpsPriceInfo = [{
    "vpsPlan": 1,
    "vpsCore": 1,
    "vpsMemory": 2,
    "vpsStorage": 10,
    "vpsBandwidth": 1000,
    "vpsPrice": 20,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 2,
    "vpsCore": 2,
    "vpsMemory": 4,
    "vpsStorage": 20,
    "vpsBandwidth": 2000,
    "vpsPrice": 40,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 3,
    "vpsCore": 3,
    "vpsMemory": 6,
    "vpsStorage": 30,
    "vpsBandwidth": 3000,
    "vpsPrice": 60,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=14"
  }, {
    "vpsPlan": 4,
    "vpsCore": 4,
    "vpsMemory": 8,
    "vpsStorage": 40,
    "vpsBandwidth": 4000,
    "vpsPrice": 80,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 5,
    "vpsCore": 5,
    "vpsMemory": 10,
    "vpsStorage": 50,
    "vpsBandwidth": 5000,
    "vpsPrice": 100,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 6,
    "vpsCore": 6,
    "vpsMemory": 12,
    "vpsStorage": 60,
    "vpsBandwidth": 6000,
    "vpsPrice": 120,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 7,
    "vpsCore": 7,
    "vpsMemory": 14,
    "vpsStorage": 70,
    "vpsBandwidth": 7000,
    "vpsPrice": 140,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=14"
  }, {
    "vpsPlan": 8,
    "vpsCore": 8,
    "vpsMemory": 16,
    "vpsStorage": 80,
    "vpsBandwidth": 8000,
    "vpsPrice": 160,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 9,
    "vpsCore": 9,
    "vpsMemory": 18,
    "vpsStorage": 90,
    "vpsBandwidth": 9000,
    "vpsPrice": 180,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=13"
  }, {
    "vpsPlan": 10,
    "vpsCore": 10,
    "vpsMemory": 20,
    "vpsStorage": 100,
    "vpsBandwidth": 10000,
    "vpsPrice": 200,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=14"
  }, {
    "vpsPlan": 11,
    "vpsCore": 11,
    "vpsMemory": 22,
    "vpsStorage": 110,
    "vpsBandwidth": 11000,
    "vpsPrice": 220,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=12"
  }, {
    "vpsPlan": 12,
    "vpsCore": 12,
    "vpsMemory": 24,
    "vpsStorage": 120,
    "vpsBandwidth": 12000,
    "vpsPrice": 240,
    "vpsWHmcsUrl": "https://whmcs.themetags.com/cart.php?a=add&pid=13"
  }];
  var cPlan = $('#c-plan');

  if (cPlan.length) {
    cPlan.slider({
      tooltip: 'always'
    });
    cPlan.on("slide", function (e) {
      $.each(vpsPriceInfo, function (index, vpsObj) {
        if (vpsObj.vpsPlan == e.value) {
          setVpsValue(vpsObj);
        }
      });
    });
    initSlider();
  }

  function initSlider() {
    cPlan.value = cPlan.data("slider-value");
    var defaultVpsCore = parseInt(cPlan.value);
    $.each(vpsPriceInfo, function (index, vpsObj) {
      // defaultVpsCore is default valeu to show. For my demo, I have set 6 from HTML.
      // vps-hosting.html: <input id="c-plan" type="text" data-slider-min="1" data-slider-max="12" data-slider-step="1" data-slider-value="6" data-currency="$" data-unit="GB">. 
      // You need to change accourting to your need.
      if (vpsObj.vpsPlan == defaultVpsCore) {
        $('.slider .tooltip', '#custom-plan').append('<div class="tooltip-up"></div>');
        $('.slider .tooltip-inner', '#custom-plan').attr("data-unit", cPlan.data("unit"));
        $('.slider .tooltip-up', '#custom-plan').attr("data-currency", cPlan.data("currency"));
        setVpsValue(vpsObj);
      }
    });
  }

  function setVpsValue(vpsObj) {
    $('.slider .tooltip-up', '#custom-plan').text(vpsObj.vpsPrice);
    $('.vpsPrice', '#custom-plan').text(cPlan.data("currency") + vpsObj.vpsPrice);
    $('.vpsCore span', '#custom-plan').text(vpsObj.vpsCore);
    $('.vpsMemory span', '#custom-plan').text(vpsObj.vpsMemory);
    $('.vpsStorage span', '#custom-plan').text(vpsObj.vpsStorage);
    $('.vpsBandwidth span', '#custom-plan').text(vpsObj.vpsBandwidth);
    $('.vpsWHmcsUrl', '#custom-plan').attr("href", vpsObj.vpsWHmcsUrl);
  } // 6. monthly, yearly, biannual and triennial pricing switch


  if ($(".billingCycle").length > 0) {
    var billingPlanInputs = $("input[name='billingPlan']");
    billingPlanInputs.change(function () {
      var billingPlan = $(this).val();
      $.each(['.monthly-price', '.yearly-price', '.biannual-price', '.triennial-price'], function (index, tag) {
        $(tag).css('display', 'none');
      });
      $('.' + billingPlan + '-price').css('display', 'block');
    });
  } // 7. tooltip


  $('.custom-map-location li span').tooltip('show'); // 8. magnify popup video

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  }); // 9. hero slider one

  $('.hero-slider-one').owlCarousel({
    loop: true,
    autoplay: true,
    dots: true,
    autoplayHoverPause: true,
    items: 1,
    smartSpeed: 1000,
    animateOut: "slideOutUp",
    animateIn: "slideInDown"
  }); // 10. hero slider two

  $('.hero-content-slider').owlCarousel({
    loop: false,
    autoplay: true,
    dots: true,
    autoplayHoverPause: true,
    items: 1,
    smartSpeed: 1000,
    animateOut: "slideOutUp",
    animateIn: "slideInDown"
  }); // 11. client-testimonial carousel

  $('.client-testimonial').owlCarousel({
    loop: true,
    margin: 30,
    nav: false,
    dots: true,
    responsiveClass: true,
    autoplay: true,
    autoplayHoverPause: true,
    lazyLoad: true,
    responsive: {
      0: {
        items: 1
      },
      500: {
        items: 1
      },
      600: {
        items: 2
      },
      800: {
        items: 2
      },
      1200: {
        items: 3
      }
    }
  }); // 12. client logo item carousel

  $('.clients-carousel').owlCarousel({
    autoplay: true,
    loop: true,
    margin: 15,
    dots: false,
    slideTransition: 'linear',
    autoplayTimeout: 4500,
    autoplayHoverPause: true,
    autoplaySpeed: 4500,
    responsive: {
      0: {
        items: 2
      },
      500: {
        items: 3
      },
      600: {
        items: 4
      },
      800: {
        items: 5
      },
      1200: {
        items: 6
      }
    }
  }); // 13. team member carousel

  $('.team-member-carousel, .gallery-img-slider').owlCarousel({
    loop: true,
    margin: 15,
    nav: false,
    dots: true,
    responsiveClass: true,
    autoplay: true,
    autoplayHoverPause: true,
    lazyLoad: true,
    responsive: {
      0: {
        items: 1
      },
      500: {
        items: 2
      },
      600: {
        items: 2
      },
      800: {
        items: 3
      },
      1200: {
        items: 4
      }
    }
  }); // 16. countdown or coming soon

  $('.clock').countdown('2022/01/30', function (event) {
    $(this).html(event.strftime('' + '<div class="row">' + '<div class="col">' + '<h2 class="mb-1">%-D</h2>' + '<h6>Day%!d</h6>' + '</div>' + '<div class="col">' + '<h2 class="mb-1">%H</h2>' + '<h6>Hours</h6>' + '</div>' + '<div class="col">' + '<h2 class="mb-1">%M</h2>' + '<h6>Minutes</h6>' + '</div>' + '<div class="col">' + '<h2 class="mb-1">%S</h2>' + '<h6>Seconds</h6>' + '</div>' + '</div>'));
  }); //new countdown

  $(function () {
    // document ready
    if ($('#countdown').length) {
      var second = 1000,
          minute = second * 60,
          hour = minute * 60,
          day = hour * 24,
          set_time = "December 30, 2022 00:00:00";
      var countDown = new Date(set_time).getTime();
      var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDown - now;
        document.getElementById("days").innerText = Math.floor(distance / day);
        document.getElementById("hours").innerText = Math.floor(distance % day / hour);
        document.getElementById("minutes").innerText = Math.floor(distance % hour / minute);
        document.getElementById("seconds").innerText = Math.floor(distance % minute / second); //do something later when date is reached

        if (distance < 0) {
          var countdown = document.getElementById("countdown");
          var content = document.getElementById("end-countdown");
          countdown.style.display = "none";
          content.style.display = "block";
          clearInterval(x);
        }
      }, second);
    }
  }); // 17. sticky sidebar

  $(function () {
    // document ready
    if ($('#sticky').length) {
      // make sure "#sticky" element exists
      var el = $('#sticky');
      var stickyTop = $('#sticky').offset().top; // returns number

      var stickyHeight = $('#sticky').height();
      $(window).scroll(function () {
        // scroll event
        var limit = $('#section-footer').offset().top - stickyHeight - 20;
        var windowTop = $(window).scrollTop(); // returns number

        if (stickyTop < windowTop) {
          el.css({
            position: 'fixed',
            top: 20,
            width: 350
          });
        } else {
          el.css('position', 'static');
        }

        if (limit < windowTop) {
          var diff = limit - windowTop;
          el.css({
            top: diff
          });
        }
      });
    }
  }); // 18. chat api js

  var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();

  (function () {
    var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/5e19bb9b27773e0d832d0621/default';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })(); // Domain extention filter


  $('.domain-filter-title').on('click', function () {
    $('.domain-filter-list').fadeToggle("slow");
  }); // 19. image gallery js

  $('.image-gallery').magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-img-mobile',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1] // Will preload 0 - before current, and 1 after the current image

    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
    }
  }); // 20. contact form

  if ($("#contactForm").length) {
    setCsrf();
    $("#contactForm").validator().on("submit", function (event) {
      if (event.isDefaultPrevented()) {
        // handle the invalid form...
        submitMSG(false);
      } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
      }
    });
  }

  function submitForm() {
    // Initiate Variables With Form Content
    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();
    var csrfToken = $("#csrfToken").val();

    if (csrfToken) {
      if (name && email && message) {
        $.ajax({
          type: "POST",
          url: "libs/contact-form-process.php",
          data: "name=" + name + "&email=" + email + "&message=" + message + "&csrfToken=" + csrfToken,
          success: function success(text) {
            if (text == "success") {
              formSuccess();
            } else {
              submitMSG(false, text);
            }
          }
        });
      } else {
        submitMSG(false, "Please enter the right information.");
      }
    } else {
      submitMSG(false, "Invalid Token");
    }
  }

  function formSuccess() {
    $("#contactForm")[0].reset();
    submitMSG(true);
  }

  function submitMSG(valid, msg) {
    if (valid) {
      $(".message-box").removeClass('d-none').addClass('d-block ');
      $(".message-box div").removeClass('alert-danger').addClass('alert-success').text('Form submitted successfully');
    } else {
      $(".message-box").removeClass('d-none').addClass('d-block ');
      $(".message-box div").removeClass('alert-success').addClass('alert-danger').text('Found error in the form. Please check again.');
    }
  }

  function setCsrf() {
    $.ajax({
      url: 'libs/csrf.php',
      type: "GET",
      dataType: "json",
      success: function success(data) {
        if (data) {
          document.getElementById("csrfToken").value = data.csrfToken;
        }
      },
      error: function error(_error) {
        console.log("Error " + _error);
      }
    });
  }
}); // JQuery end
("use strict");

document.addEventListener("DOMContentLoaded", () => {

  // Smooth scrolling
  $(".header__menu, .footer__menu, .mobile-menu").on('click', '[href*="#"]', function(e){
    var fixed_offset = 0;
    $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
    e.preventDefault();
  });
  // END Smooth scrolling


  // STIKY HEADER WITH HIDDEN ON SCROLL -------------------------------------------------

  var header = $(".header");
  var scrollTrigger = 50;
  function updateHeaderClasses() {
      var scrollPosition = $(window).scrollTop();
      if (scrollPosition > scrollTrigger) {
          header.addClass("active");
      } else {
          header.removeClass("active");
      }
  }
  updateHeaderClasses();
  $(window).on('scroll', function() {
      updateHeaderClasses();
  });

  $(document).ready(function () {
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var desktopNavbarHeight = $('.header').outerHeight();
    var mobileNavbarHeight = desktopNavbarHeight + 100;

    $(window).scroll(function (event) {
      didScroll = true;
    });

    setInterval(function () {
      if (didScroll) {
        hasScrolled();
        didScroll = false;
      }
    }, 100);

    function hasScrolled() {
      var st = $(this).scrollTop();
      var windowWidth = $('body').innerWidth();

      // Mobile
      if (windowWidth <= 1170) {
        if (Math.abs(lastScrollTop - st) <= delta) {
          return;
        }

        if (st > lastScrollTop && st > mobileNavbarHeight) {
          // Scroll Down
          $('.header').removeClass('nav-down').addClass('nav-up');
        } else {
          // Scroll Up
          if (st + $(window).height() < $(document).height()) {
            $('.header').removeClass('nav-up');
            if (st > mobileNavbarHeight) {
              $('.header').addClass('nav-down');
            }
          }
        }
      }
      // PC
      else {
        if (Math.abs(lastScrollTop - st) <= delta) {
          return;
        }

        if (st > lastScrollTop && st > 150) {
          // Scroll Down
          $('.header').removeClass('nav-down').addClass('nav-up');
        } else {
          // Scroll Up
          if (st + $(window).height() < $(document).height()) {
            $('.header').removeClass('nav-up');
            if (st > 650) {
              $('.header').addClass('nav-down');
            }
          }
        }
      }
      lastScrollTop = st;
    }
  });

  // STIKY HEADER WITH HIDDEN ON SCROLL END -------------------------------------------------



  $('.menu-btn').click(function (e){
    e.preventDefault();
    $('.mobile-menu').toggleClass('mobile-menu_active');
    $('.overlay').toggleClass('overlay_active');
    $("body").toggleClass("locked");
  });

  $('.close, .overlay, .mobile-menu a, .mobile-menu .btn-open-modal').click(function (){
    $('.mobile-menu').removeClass('mobile-menu_active');
    $('.overlay').removeClass('overlay_active');
    $("body").removeClass("locked");
  });

  // Language switching
  const $menu = $('.header-lang');
  $(document).mouseup(e => {
  if (!$menu.is(e.target)
  && $menu.has(e.target).length === 0)
  {
      $menu.removeClass('is-active');
  }
  });
  $('.header-lang-trigger').on('click', () => {
      $menu.toggleClass('is-active');
  });
  // END Language switching


  // Slider
  var swiper = new Swiper(".works__slider", {
      spaceBetween: 30,
      scrollbar: {
        el: ".swiper-scrollbar",
        hide: true,
      },

      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10
        },
        710: {
          slidesPerView: 1.8,
        },
        1169: {
          slidesPerView: 3,
          spaceBetween: 30
        }
      }
  });
  //END Slider


  // Tabs ------------------------
  $(".tabs").each(function() {
    var $this = $(this);
    var $tabs = $this.find(".tabs__content .tab-button");
    var $tabItems = $this.find(".tab-item");
    var currentTab = 0;

    $tabItems.removeClass("active").eq(currentTab).addClass("active");
    $tabs.eq(currentTab).addClass("active");

    $tabs.click(function() {
        currentTab = $(this).index();
        showTab(currentTab);
    });

    $this.find(".arrow").click(function(event) {
        event.stopPropagation(); 
        currentTab = (currentTab + 1) % $tabs.length;
        showTab(currentTab);
    });

    function showTab(index) {
        $tabs.removeClass("active").eq(index).addClass("active");
        $tabItems.removeClass("active").eq(index).addClass("active");
    }
  });

  // END Tabs -------------- 


  // Accordion -------------------------------------------------
  $('.accordion__item-num').each(function(index) {
    $(this).text(index + 1 + '.');
  });

  $('.accordion__item-top-wrapper').click(function() {
    var $clickedItem = $(this);
    var $parentItem = $clickedItem.closest('.accordion__item');

    if ($clickedItem.hasClass('active')) {
        $clickedItem.removeClass('active');
        $parentItem.find('.accordion__item-more').removeClass('active');
        $parentItem.removeClass('active');
    } else {
        $('.accordion__item-top-wrapper').removeClass('active');
        $('.accordion__item-more').removeClass('active');
        $('.accordion__item').removeClass('active');
        $clickedItem.addClass('active');
        $parentItem.find('.accordion__item-more').addClass('active');
        $parentItem.addClass('active');
    }
  });

  $(`.accordion__item:first-child, .accordion__item:first-child .accordion__item-top-wrapper,.accordion__item:first-child .accordion__item-more`).addClass('active');

  // END Accordion -------------------------------------------------



  $(".btn-open-modal").click(function () {
    $('body').addClass('locked');
    $('.overlay').addClass('overlay_active');
    $('.my_box').fadeIn(100);
    var iddiv = $(this).attr("iddiv");
    $('#' + iddiv).fadeIn(100);
    $('.my_box').attr('opendiv', iddiv);
    return false;
  });


  $('.close-modal, .overlay').click(function () {
    $('body').removeClass('locked');
    $('.overlay').removeClass('overlay_active');
    var iddiv = $(".my_box").attr('opendiv');
    $('.my_box').fadeOut(100);
    $('#' + iddiv).fadeOut(100);
  });

  $('.popup-success-close, .popup-success-close-btn').click(function () {
    $('.popup-success').fadeOut(100);
    $('.overlay').removeClass('overlay_active');
    if (popupSuccessTimeout) {
      clearTimeout(popupSuccessTimeout);
      popupSuccessTimeout = null;
    }
  });

   // Add a click event listener to the button
	$('.your-plan__form-btn').on('click', function() {
		// Get the value of the span
		const totalAmount = $('.total-amount-val').text();
		const numPeople = $('.num-people-val').text();
		// Set the value of the input to the value of the span
		$('#num-people').val(numPeople);
		$('#total-amount').val(totalAmount);
  });

  $("#box_1 .acceptance-checkbox__block-l .wpcf7-list-item").append('<label for="acceptance-checkbox"></label>');
	$("#box_2 .acceptance-checkbox__block-l .wpcf7-list-item").append('<label for="acceptance-checkbox-two"></label>');

  let popupSuccessTimeout;
  $(document).on('wpcf7mailsent', function(event) {
    // Check if all required fields are filled
    var form = $(event.target);
    var allFieldsFilled = true;
    form.find('.wpcf7-form-control').each(function() {
      if ($(this).prop('required') && !$(this).val()) {
        allFieldsFilled = false;
        return false;
      }
    });
  
    // If all required fields are filled, show success popup
    if (allFieldsFilled) {
      $('body').removeClass('locked');
      var iddiv = $(".my_box").attr('opendiv');
      $('.my_box').fadeOut(100);
      $('#' + iddiv).fadeOut(100);

      $('.popup-success').fadeIn(100);
      popupSuccessTimeout = setTimeout(function () {
        $('.popup-success').fadeOut(100);
        $('.overlay').removeClass('overlay_active');
      }, 4000);
    }
  });

  // Hero Swiper Slider
  if (document.querySelector('.hero-swiper')) {
    const heroSwiper = new Swiper('.hero-swiper', {
      loop: true,
    //   autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    //   },
      speed: 800,
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      },
      pagination: {
        el: '.hero-pagination',
        clickable: true,
      },
    });
  }


  // Favorite products functionality
  $('.product-card__favorite').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    var $button = $(this);
    var productId = $button.data('product-id');
    
    // Get favorites from localStorage
    var favorites = JSON.parse(localStorage.getItem('favoriteProducts') || '[]');
    
    // Toggle favorite
    var index = favorites.indexOf(productId);
    if (index > -1) {
      // Remove from favorites
      favorites.splice(index, 1);
      $button.removeClass('is-favorite');
    } else {
      // Add to favorites
      favorites.push(productId);
      $button.addClass('is-favorite');
    }
    
    // Save to localStorage
    localStorage.setItem('favoriteProducts', JSON.stringify(favorites));
    
    // Update favorite icon in header (if exists)
    updateFavoriteCount();
  });
  
  // Initialize favorite states on page load
  function initializeFavorites() {
    var favorites = JSON.parse(localStorage.getItem('favoriteProducts') || '[]');
    favorites.forEach(function(productId) {
      $('.product-card__favorite[data-product-id="' + productId + '"]').addClass('is-favorite');
    });
    updateFavoriteCount();
  }
  
  // Update favorite count in header
  function updateFavoriteCount() {
    var favorites = JSON.parse(localStorage.getItem('favoriteProducts') || '[]');
    var count = favorites.length;
    var $favoriteIcon = $('.header__icon-favorite');
    
    // Remove existing count
    $favoriteIcon.find('.favorite-count').remove();
    
    // Add new count if > 0
    if (count > 0) {
      $favoriteIcon.append('<span class="favorite-count">' + count + '</span>');
    }
  }
  
  // Initialize favorites on page load
  initializeFavorites();

});
export default {
  init() {
    /**
     * Menu related scripts
     */
    var prevScrollpos = window.pageYOffset;

    $(window).scroll(function () {
      // Add background color and shrink menu when scrolling down
      var $topbar = document.getElementById('topbar');
      if ($(document).scrollTop() > 100) {
        $topbar.classList.add('bg-white');
        $topbar.classList.remove('py-4');
      } else {
        $topbar.classList.remove('bg-white');
        $topbar.classList.add('py-4');
      }

      // On mobile, hide topbar on scroll down and show on scroll up
      var currentScrollPos = window.pageYOffset;
      if (window.screen.width < 991) {
        if (prevScrollpos > currentScrollPos) {
          $topbar.style.top = '0';
        } else {
          $topbar.style.top = '-100px';
        }
        prevScrollpos = currentScrollPos;
      }
    });

    // Open menu when focusing element
    $(function () {
      $('.menu-item-has-children a').focus(function () {
        $(this).siblings('.sub-menu').addClass('is-focused');
      }).blur(function () {
        $(this).siblings('.sub-menu').removeClass('is-focused');
      });

      // Sub Menu
      $('.sub-menu a').focus(function () {
        $(this).parents('.sub-menu').addClass('is-focused');
      }).blur(function () {
        $(this).parents('.sub-menu').removeClass('is-focused');
      });
    });

    /**
     * Accordions
     */
    // TODO: make elements focusable and open on enter
    // Open and close FAQ accordion
    $('strong.schema-faq-question').click(function () {
      if (!$(this).hasClass('active')) {
        $(this).addClass('active');
        $(this).next().slideToggle();
      } else {
        $(this).removeClass('active');
        $(this).next().slideToggle();
      }
    });

    /**
     * Add +1
     */
    /*
    $('.quantity input').before('<button id="plusone" class="btn button" type="button">Add +1</button>');

    $('#plusone').click(function () {
      console.log($('.qty').val());
      var $value = parseInt($('.qty').val()) + 1;
      console.log($value);
      //$('.quantity input').value += 1;
      //console.log($('.quantity input').value);
      $('.qty').val($value);
    })
    */
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
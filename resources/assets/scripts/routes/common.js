export default {
  init() {
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

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

export default {
  init() {
    // Change menu when scrolling down
    $(window).scroll(function () {
      var $topbar = document.getElementById('topbar');
      if ($(document).scrollTop() > 100) {
        $topbar.classList.add('bg-white');
        $topbar.classList.remove('py-4');
      } else {
        $topbar.classList.remove('bg-white');
        $topbar.classList.add('py-4');
      }
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

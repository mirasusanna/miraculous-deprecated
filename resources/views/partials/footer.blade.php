<footer class="site-footer py-10 md:py-16 lg:py-20">
  <div class="container flex flex-wrap lg:flex-no-wrap">
    @if (has_nav_menu('footer_navigation'))
      {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav nav--footer', 'container' => 'nav']) !!}
    @endif
    @if (is_active_sidebar('sidebar-footer-1'))
      <div class="flex w-full lg:flex-1">
        @php dynamic_sidebar('sidebar-footer-1') @endphp
      </div>
    @endif
    @if (is_active_sidebar('sidebar-footer-2'))
      <div class="flex w-full lg:flex-1">
        @php dynamic_sidebar('sidebar-footer-2') @endphp
      </div>
    @endif
    @if (is_active_sidebar('sidebar-footer-3'))
      <div class="flex w-full lg:flex-1">
        @php dynamic_sidebar('sidebar-footer-3') @endphp
      </div>
    @endif
    @if (is_active_sidebar('sidebar-footer-4'))
      <div class="flex w-full lg:flex-1">
        @php dynamic_sidebar('sidebar-footer-4') @endphp
      </div>
    @endif
  </div>
</footer>

<footer class="site-footer py-10 md:py-16 lg:py-20">
  <div class="container">
    @if (has_nav_menu('footer_navigation'))
      {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav nav--footer', 'container' => 'nav']) !!}
    @endif
    @php dynamic_sidebar('sidebar-footer') @endphp
  </div>
</footer>

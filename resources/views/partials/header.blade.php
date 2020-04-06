<header id="topbar" class="banner fixed z-50 py-4 px-4 w-full flex flex-wrap justify-between items-center">
  <a class="p-2 h-16" title="{{ get_bloginfo('name', 'display') }}" href="{{ home_url('/') }}">
    @include('atoms/logo')
  </a>
  <div class="flex">
    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav nav--primary', 'container' => 'nav']) !!}
    @endif
  </div>
</header>

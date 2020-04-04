<header class="banner">
  <div class="container flex flex-wrap justify-center h-full">
    <a class="hover:border-transparent h-16" title="{{ get_bloginfo('name', 'display') }}" href="{{ home_url('/') }}">
      @include('atoms/logo')
    </a>
    <nav class="nav-primary w-full">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>

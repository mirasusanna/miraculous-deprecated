<header class="banner">
  <div class="container">
    <a class="brand" title="{{ get_bloginfo('name', 'display') }}" href="{{ home_url('/') }}">
      @include('atoms/logo')
    </a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>

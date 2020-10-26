<header id="topbar" class="banner fixed top-0 z-50 py-4 px-4 w-full flex flex-no-wrap lg:flex-wrap justify-between bg-white">
  <div class="flex lg:w-full justify-center">    
    <a class="p-2 h-16" title="{{ get_bloginfo('name', 'display') }}" href="{{ home_url('/') }}">
      @include('components/logo')
    </a>
  </div>
  <div class="flex lg:w-full justify-center">
    <button id="mobile-menu-toggle" class="inline-block lg:hidden">Menu</button>
    @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu([
        'theme_location' => 'primary_navigation',
        'menu_class' => 'nav nav--primary',
        'container_id' => 'main-menu-container',
        'menu_id' => 'main-menu',
        'container' => 'nav',
        'container_class' => 'main-menu-container hidden lg:flex'
      ]) !!}
    @endif
  </div>
</header>

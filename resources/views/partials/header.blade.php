@php
  global $woocommerce;
@endphp
<header id="topbar" class="banner z-50 top-0 bg-white w-full">
  <div class="hidden lg:flex z-50 pt-4 px-4 w-full flex-wrap shadow justify-center">
    <div class="flex lg:w-full justify-between">
      <a class="p-2 h-16" title="{{ get_bloginfo('name', 'display') }}" href="{{ home_url('/') }}">
        @include('components/logo')
      </a>
      <div class="flex">
        <div class="mr-4">
          {!! get_search_form(false) !!}
        </div>
        <nav class="flex">
          <a href="{{ wc_get_cart_url() }}" class="shopping-cart">
            <span class="sr-only">Ostoskori</span>
            <span class="shopping-cart__number">{{ $woocommerce->cart->cart_contents_count }}<span class="sr-only"> tuotetta ostoskorissa</span></span>
            <img class="shopping-cart__icon" src="@asset('images/shopping-cart.svg')" alt="" />
          </a>
          <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="shopping-cart">
            <span class="sr-only">Profiili</span>
            <img class="shopping-cart__icon" src="@asset('images/user.svg')" alt="" />
          </a>
        </nav>
      </div>
    </div>
    <div class="flex w-full justify-center">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav nav--primary',
          'container_id' => 'main-menu-container',
          'menu_id' => 'main-menu',
          'container' => 'nav',
          'container_class' => 'main-menu-container lg:flex'
        ]) !!}
      @endif
    </div>
  </div>
  <div class="flex lg:hidden shadow top-0 py-1 px-3 w-full flex-no-wrap items-center"> 
    <a class="p-2 h-16" title="{{ get_bloginfo('name', 'display') }}" href="{{ home_url('/') }}">
      @include('components/logo')
    </a>
    <div class="flex flex-no-wrap items-center ml-auto relative z-20">
      <a href="{{ wc_get_cart_url() }}" class="shopping-cart">
        <span class="sr-only">Ostoskori</span>
        <span class="shopping-cart__number">{{ $woocommerce->cart->cart_contents_count }}<span class="sr-only"> tuotetta ostoskorissa</span></span>
        <img class="shopping-cart__icon" src="@asset('images/shopping-cart.svg')" alt="" />
      </a>
      <a href="{{ get_permalink( get_option('woocommerce_myaccount_page_id') ) }}" class="shopping-cart">
        <span class="sr-only">Profiili</span>
        <img class="shopping-cart__icon" src="@asset('images/user.svg')" alt="" />
      </a>
      <button id="mobile-menu-toggle" class="js-mobile-menu-toggle mobile-menu-toggle lg:hidden">
        <span class="sr-only">Menu</span>
        <span class="mobile-menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
      </button>
    </div>
    <div id="mobile-menu-container" class="mobile-menu-container z-10 w-screen h-screen bg-white">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav main-menu-mobile__list',
          'menu_id' => 'main-menu-mobile',
          'container' => 'nav',
          'container_class' => 'main-menu-mobile'
        ]) !!}
      @endif
    </div>
  </div>
</header>

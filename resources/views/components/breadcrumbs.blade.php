{{-- Display Breadcrumb NavXT or Yoast breadcrumbs --}}
@if (function_exists('bcn_display'))
  <p class="breadcrumbs text-base">{{ bcn_display() }}</p>
@elseif (function_exists('yoast_breadcrumb'))
  @php yoast_breadcrumb('<p class="breadcrumbs text-base">','</p>') @endphp
@endif

@php
  $logo_id = get_theme_mod( 'custom_logo' );
  $logo_url = wp_get_attachment_image_url( $logo_id , 'full' );
@endphp
@if(!empty($logo_url))
  <img src="{{ esc_url($logo_url) }}" alt="{{ get_bloginfo('name', 'display') }}">
@else
  {{ get_bloginfo('name', 'display') }}
@endif

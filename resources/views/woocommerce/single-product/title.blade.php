
{{--
Single Product title

@see      https://docs.woocommerce.com/document/template-structure/
@package  WooCommerce/Templates
@version  3.0.0
--}}

@php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
@endphp

@if(taxonomy_exists('berocket_brand'))
  @php
    $brands = get_the_terms( $product->get_id(), 'berocket_brand' );
  @endphp
  @foreach ($brands as $brand)
    @php
      $brand_name = $brand->name;
      $brand_url = get_category_link($brand->term_id);
    @endphp
    <a class="uppercase text-xl mb-2 inline-block" href="{{ $brand_url }}">{{ $brand_name }}</a>
  @endforeach
@endif

@php
  the_title( '<h1 class="product_title entry-title">', '</h1>' );
@endphp

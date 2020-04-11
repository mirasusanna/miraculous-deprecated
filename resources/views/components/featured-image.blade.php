<div class="featured-image mb-4 md:mb-6 lg:mb-8">
<!-- TODO: don't upload full image size -->
  @php the_post_thumbnail('large') @endphp
  @if (get_the_post_thumbnail_caption())
    <figcaption class="mt-2">{{ the_post_thumbnail_caption() }}</figcaption>
  @endif
</div>

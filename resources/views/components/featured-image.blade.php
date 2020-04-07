<div class="featured-image">
<!-- TODO: don't upload full image size -->
  @php the_post_thumbnail('large') @endphp
  @if (get_the_post_thumbnail_caption())
    <figcaption>{{ the_post_thumbnail_caption() }}</figcaption>
  @endif
</div>

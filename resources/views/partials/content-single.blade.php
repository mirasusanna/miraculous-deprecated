<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
    @if(has_excerpt())
      <p class="text-lg md:text-xl lg:text-2xl mb-4 lg:mb-8">{{ get_the_excerpt() }}</p>
    @endif
  </header>
  <div class="entry-content">
    @if (has_post_thumbnail())
      @include('components/featured-image')
    @endif
    @php the_content() @endphp
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>

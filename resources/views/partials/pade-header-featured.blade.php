@if (has_post_thumbnail())
  <div class="page-header page-header--large has-background breakout" style="background-image: url(' {{ the_post_thumbnail_url() }} ');">
    <h1>{!! App::title() !!}</h1>
  </div>
@else
<div class="page-header page-header--large">
  <h1>{!! App::title() !!}</h1>
</div>
@endif

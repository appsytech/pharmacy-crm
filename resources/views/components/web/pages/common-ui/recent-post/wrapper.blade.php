  @props([
  'recents' => collect([]),
  'detailRouteName'
  ])

  <div class="widget  ">
      <h3 class="widget_title">Recent Posts</h3>
      <div class="recent-post-wrap">

          @if($recents->isNotEmpty())
          @foreach($recents as $recent)
          <x-web.pages.common-ui.recent-post.partials.post :recent="$recent" :detailRouteName="$detailRouteName" />
          @endforeach
          @endif
      </div>
  </div>
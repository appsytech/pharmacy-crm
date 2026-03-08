  @props([
  'categories' => collect([])
  ])

  <aside class="sidebar-area">
      <div class="widget widget_search  ">
          <form class="search-form">
              <input type="text" placeholder="Enter Keyword">
              <button type="submit"><i class="far fa-search"></i></button>
          </form>
      </div>

      <div class="widget widget_categories  ">
          <h3 class="widget_title">Categories</h3>
          <ul>
              @if($categories->isNotEmpty())
              @foreach($categories as $category)
              <li>
                  <a href="#">{{ $category->title ?? $category->name ?? '' }}</a>
              </li>
              @endforeach
              @endif

          </ul>
      </div>

      {{ $slot }}

  </aside>
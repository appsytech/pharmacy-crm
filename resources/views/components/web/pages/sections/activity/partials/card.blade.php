      @props([
      'activity'
      ])

      @php
      use Carbon\Carbon;
      @endphp

      <div class="th-blog blog-single has-post-thumbnail">
          <div class="blog-img">
              <a href="{{ route('web.activity.show', encrypt($activity->id)) }}">
                  @isset($activity->images)
                  <img src="{{ asset('storage/' . $activity->images) }}" alt="Activity Image">
                  @endisset
              </a>
          </div>
          <div class="blog-content">
              <div class="blog-meta">
                  <!-- <a class="author" href="{{ route('web.activity.index') }}">
                      <i class="fal fa-user"></i>
                      By Tata Medical
                  </a> -->
                  <a href="{{ route('web.activity.index') }}">
                      <i class="fal fa-calendar"></i>
                      {{ Carbon::parse($activity->created_at)->format('d F, Y') }}
                  </a>
                  <!-- <a href="{{ route('web.activity.show', encrypt($activity->id)) }}">
                      <i class="fal fa-comments"></i>
                      Comments (3)
                  </a> -->
              </div>
              <h2 class="blog-title"><a href="{{ route('web.activity.show', encrypt($activity->id)) }}">{{ $activity->title ?? '' }}</a>
              </h2>
              <p class="blog-text">{{ $activity->description ?? '' }}</p>
              <a href="{{ route('web.activity.show', , encrypt($activity->id)) }}" class="th-btn btn-sm">Read More</a>
          </div>
      </div>
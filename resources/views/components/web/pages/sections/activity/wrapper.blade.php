@props([
'activities' => collect([]),
'categories' => collect([])
])

<section class="th-blog-wrapper space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-lg-7">

                @if($activities->isNotEmpty())
                @foreach($activities as $activity)
                <x-web.pages.sections.activity.partials.card :activity="$activity" />
                @endforeach
                @endif


                <div class="th-pagination text-center">
                    <ul>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="far fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-xxl-4 col-lg-5">

                <x-web.pages.common-ui.side-category-widget.wrapper :categories="$categories">
                    <x-slot>
                        <x-web.pages.common-ui.recent-post.wrapper />
                        <x-web.pages.common-ui.tags.wrapper />
                    </x-slot>
                </x-web.pages.common-ui.side-category-widget.wrapper>

            </div>
        </div>
    </div>
</section>
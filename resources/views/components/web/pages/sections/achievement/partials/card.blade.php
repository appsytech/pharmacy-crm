 @props([
 'year',
 'imgUrl',
 'title',
 'description'
 ])

 <div {{ $attributes->class(['achieve-box hover-item'])->merge() }}>
     <div class="box-img">
         <img src="{{ $imgUrl ?? '#' }}" alt="Image">
     </div>
     <div class="box-year">{{ $year ?? '#' }}</div>
     <div class="media-body">
         <h3 class="box-title">{{ $title ?? '#' }}</h3>
         <p class="box-text">{{ $description ?? '#' }}</p>
     </div>
 </div>
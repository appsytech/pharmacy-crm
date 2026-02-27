 @props([
 'imgUrl',
 'boxNumber',
 'title',
 'description'
 ])

 <div class="process-card">
     <div class="box-img">
         <div class="img">
             <img src="{{ $imgUrl ?? '#' }}" alt="icon">
         </div>
         <p class="box-number">{{ $boxNumber ?? 0 }}</p>
     </div>
     <h3 class="box-title">{{ $title }}</h3>
     <p class="box-text">{{ $description }}</p>
 </div>
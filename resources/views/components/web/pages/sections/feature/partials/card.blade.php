 @props([
 'imgUrl',
 'title',
 'description'
 ])


 <div class="col-xl-3 col-sm-6">
     <div class="why-feature" data-bg-src="{{ asset('assets/img/bg/why_feature_bg.png') }}">
         <div class="box-icon">
             <img src="{{ $imgUrl }}" alt="icon">
         </div>
         <h3 class="box-title">{{ $title }}</h3>
         <p class="box-text">{{ $description }}</p>
     </div>
 </div>
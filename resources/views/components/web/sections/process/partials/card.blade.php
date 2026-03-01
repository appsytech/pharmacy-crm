 @props([
 'process'
 ])

 <div class="process-card">
     <div class="box-img">
         <div class="img">
             @isset($process->images)
             <img src="{{ asset('storage/' . $process->images) }}" alt="icon">
             @endisset
         </div>
         <p class="box-number">{{ $process->sn ?? 0 }}</p>
     </div>
     <h3 class="box-title">{{ $process->title ?? '' }}</h3>
     <p class="box-text">{{ $process->description ?? '' }}</p>
 </div>
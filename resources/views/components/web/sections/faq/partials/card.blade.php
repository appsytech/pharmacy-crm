 @props([
 'question',
 'answer'
 ])

 @php
 $collapseItemId = uniqid('collapse_item_');
 $collapseId = uniqid('collapse_');
 @endphp

 <div class="accordion-card">
     <div class="accordion-header" id="{{ $collapseItemId }}">
         <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="true" aria-controls="{{ $collapseId }}">{{ $question ?? '' }}</button>
     </div>
     <div id="{{ $collapseId }}" class="accordion-collapse collapse show" aria-labelledby="{{ $collapseItemId }}" data-bs-parent="#faqAccordion">
         <div class="accordion-body">
             <p class="faq-text">{!! $answer ?? '' !!}</p>
         </div>
     </div>
 </div>
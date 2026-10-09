 <section class="facilities-section" id="facilities">
     <div class="section-container">
         <div class="section-header-centered reveal">
             <div class="section-label">OUR CAMPUS</div>
             <h2 class="section-heading">Facilities &amp; Infrastructure</h2>
             <p class="section-sub">A serene, calm environment designed to help you reconnect with your calling</p>
         </div>
         <div class="facilities-grid-new">
             @foreach ($facilites as $facility)
                 <div class="facility-card-new reveal"
                     style="background-image: url('{{ asset('storage/' . $facility->feature_image) }}');">
                     <div class="facility-card-overlay"></div>
                     <div class="facility-card-content">
                         <h3 class="facility-title-new"><a href="{{ $facility->slug_url }}">{{ $facility->title }}</a>
                         </h3>
                         <p class="facility-desc-new">{!! $facility->excerpt !!}</p>
                     </div>
                 </div>
             @endforeach

         </div>
     </div>
 </section>

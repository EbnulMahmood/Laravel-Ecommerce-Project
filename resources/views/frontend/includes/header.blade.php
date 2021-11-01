<!-- Header -->

<section class="section bg-white">
  <div class="container">
      <header class="wow fadeInUp" data-wow-delay=".1s">
          <div class="row justify-content-center pt-5">
              <div class="col-lg-8">
                  <label class="pre-label mb-0">
                    {{ (session()->get('language') == 'bangla') ? 'এখনই কিনুন' : 'Shop now' }}
                  </label>
                  <h2 class="display-2">
                    @if(session()->get('language') == 'bangla')
                        <strong>নতুন সংগ্রহ এখানে!</strong> আপনার 40% ছাড় পান
                    @else
                        <strong>New collection is here!</strong> Get your 40% discount
                    @endif
                  </h2>
              </div>
          </div>
      </header>
  </div>
</section>
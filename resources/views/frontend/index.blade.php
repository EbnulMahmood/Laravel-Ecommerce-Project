@extends('frontend.main_master')
@section('content')
@section('title')
    Reveal - Clothing template
@endsection
@include('frontend.includes.header')

<!-- Top columns -->

<section class="bg-white p-0">
  <div class="container">
      <div class="row">

        @foreach ($topcategories as $category)
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="wow fadeInUp" data-wow-delay=".2s">
                    <div class="box box-image box-hover-fall br-sm" style="background-image:url({{ asset($category->category_icon) }})">
                        <div class="box-spacer-xl"></div>
                        <div class="box-content">
                            <h2 class="display-4 font-family-body text-white">
                                <strong style="color: white; background-color: black;">
                                    {{ (session()->get('language') == 'bangla') ? $category->category_name_bn : $category->category_name_en }}
                                </strong>
                            </h2>
                            <p><span><a href="#" class="text-muted">New arrivals</a></span></p>
                            <p><span><a href="#" class="text-muted">Discount sales</a></span></p>
                            <p><span><a href="#" class="text-muted">More</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

      </div>
  </div>
</section>

<!-- Sport collections -->

<section class="bg-white">
  <div class="container">

      <header class="wow fadeInUp" data-wow-delay=".2s">
          @if(session()->get('language') == 'bangla')
              <h2 class="display-4">অন্বেষণ করুন <strong>খেলাধুলার</strong> সংগ্রহগুলি</h2>
          @else
              <h2 class="display-4">Explore <strong>sport</strong> collections</h2>
          @endif
      </header>

      <div class="wow fadeInUp" data-wow-delay=".2s">
          <div class="row">
              <div class="col mb-3 mb-lg-0">
                  <a href="#" class="btn btn-rounded btn-block btn-outline-dark">Outdoor</a>
              </div>
              <div class="col mb-3 mb-lg-0">
                  <a href="#" class="btn btn-rounded btn-block btn-outline-dark">Training</a>
              </div>
              <div class="col mb-3 mb-lg-0">
                  <a href="#" class="btn btn-rounded btn-block btn-outline-dark">Running</a>
              </div>
              <div class="col mb-3 mb-lg-0">
                  <a href="#" class="btn btn-rounded btn-block btn-outline-dark">Fintess</a>
              </div>
              <div class="col mb-3 mb-lg-0">
                  <a href="#" class="btn btn-rounded btn-block btn-outline-dark">Wintersport</a>
              </div>
              <div class="col mb-3 mb-lg-0">
                  <a href="#" class="btn btn-rounded btn-block btn-dark text-nowrap">All categories</a>
              </div>
          </div>
      </div>

  </div>
</section>

<hr class="m-0">

<!-- Popular categories -->

<section class="bg-white">
  <div class="container">

      <header class="wow fadeInUp" data-wow-delay=".2s">
            @if(session()->get('language') == 'bangla')
                <h2 class="display-4">জনপ্রিয় <strong>ক্যাটেগরীজ</strong></h2>
            @else
                <h2 class="display-4">Popular <strong>categories</strong></h2>
            @endif
      </header>

      <div class="row">
        
        @foreach ($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="wow fadeInUp" data-wow-delay=".7s">
                    <a href="{{ route('shop.category', ['id' => $category->id, 'slug' => $category->category_slug_en]) }}" class="box box-image box-hover-pull br-sm" style="background-image:url({{ asset($category->category_icon) }})">
                        <div class="box-spacer-xl"></div>
                        <div class="box-content text-white text-center">
                            <header>
                                <span style="color: white; background-color: black;" class="display-4">
                                    <strong>
                                        {{ (session()->get('language') == 'bangla') ? $category->category_name_bn : $category->category_name_en }}
                                    </strong>
                                </span>
                            </header>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

      </div>
  </div>
</section>

<hr class="m-0">

<!-- Sale black friday -->

<section class="bg-white">
  <div class="container">

      <header class="wow fadeInUp" data-wow-delay=".2s">
          @if(session()->get('language') == 'bangla')
              <h2 class="display-4">বিক্রয় 70% ছাড় <strong>ব্ল্যাক ফ্রাইডে</strong></h2>
          @else
              <h2 class="display-4">Sale <strong>black friday</strong> 70% off</h2>
          @endif
      </header>

      <div class="row mx-n1">
          
        @foreach ($featured_products as $product)
            @include('frontend.components.product.product')
        @endforeach

      </div>

      <div class="text-right pt-4">
          <a href="#" class="link link-main link-dark">
            {{ (session()->get('language') == 'bangla') ? 'সংগ্রহ দেখুন' : 'View collection' }}
          </a>
      </div>

  </div>

</section>

<!-- Banner winter is beautiful -->

<section class="bg-dark cover" style="background-image: url({{ asset('frontend/assets/images/templates//clothing/gallery-5.jpg') }});">
  <div class="container">
      <div class="row justify-content-start">
          <div class="col-md-6">
            @if(session()->get('language') == 'bangla')
                <h2 class="display-4">সুন্দর <strong>শীত</strong></h2>
                <p>সমস্ত আবহাওয়ার জন্য জ্যাকেট, জুতা এবং আনুষাঙ্গিক।</p>
                <a href="#" class="btn btn-rounded btn-outline-dark">সংগ্রহ দেখুন</a>
            @else
                <h2 class="display-4">Winter is <strong>beautiful</strong></h2>
                <p>Jackets, shoes and accessories for all weathers.</p>
                <a href="#" class="btn btn-rounded btn-outline-dark">View collection</a>
            @endif
          </div>
      </div>
  </div>
</section>

<!-- Popular woman&#x27;s products -->

<section class="bg-white">
  <div class="container">

      <header class="wow fadeInUp" data-wow-delay=".2s">
          @if(session()->get('language') == 'bangla')
              <h2 class="display-4"><strong>মহিলাদের</strong> জনপ্রিয় পণ্য</h2>
          @else
              <h2 class="display-4">Popular <strong>woman's</strong> products</h2>
          @endif
      </header>

      <div class="row mx-n1">
          <div class="col-6 col-xl-3 p-1">
              <div class="wow fadeInUp" data-wow-delay=".0s">
                  <div class="card card-fill">
                      <div class="card-body p-3 p-lg-4">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h2 class="card-title mb-1 h5">
                                      <a href="product.html" class="text-dark">
                                          Coretta
                                      </a>
                                  </h2>
                                  <small class="pre-label text-muted">
                                      <span>$490</span>
                                      <s>$875</s>
                                  </small>
                              </div>
                              <div>
                                  <a href="product.html" class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Add to cart">
                                      <i class="icon icon-cart font-size-xl"></i>
                                  </a>
                              </div>
                          </div>
                      </div>

                      <div class="card-image pb-4">
                          <a href="#">
                              <img src="{{ asset('frontend/assets/images/templates//clothing/cloth-1.jpg') }}" class="card-img-top img-hover" data-img="{{ asset('frontend/assets/images/templates//clothing/cloth-1.jpg') }}" data-img-hover="{{ asset('frontend/assets/images/templates//clothing/cloth-1a.jpg') }}" alt="...">
                          </a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-6 col-xl-3 p-1">
              <div class="wow fadeInUp" data-wow-delay=".1s">
                  <div class="card card-fill">
                      <div class="card-body p-3 p-lg-4">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h2 class="card-title mb-1 h5">
                                      <a href="product.html" class="text-dark">
                                          Tonya
                                      </a>
                                  </h2>
                                  <small class="pre-label text-muted">
                                      <span>$419</span>
                                      <s>$957</s>
                                  </small>
                              </div>
                              <div>
                                  <a href="product.html" class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Add to cart">
                                      <i class="icon icon-cart font-size-xl"></i>
                                  </a>
                              </div>
                          </div>
                      </div>

                      <div class="card-image pb-4">
                          <a href="#">
                              <img src="{{ asset('frontend/assets/images/templates//clothing/cloth-2.jpg') }}" class="card-img-top img-hover" data-img="{{ asset('frontend/assets/images/templates//clothing/cloth-2.jpg') }}" data-img-hover="{{ asset('frontend/assets/images/templates//clothing/cloth-2a.jpg') }}" alt="...">
                          </a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-6 col-xl-3 p-1">
              <div class="wow fadeInUp" data-wow-delay=".2s">
                  <div class="card card-fill">
                      <div class="card-body p-3 p-lg-4">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h2 class="card-title mb-1 h5">
                                      <a href="product.html" class="text-dark">
                                          Raven
                                      </a>
                                  </h2>
                                  <small class="pre-label text-muted">
                                      <span>$502</span>
                                      <s>$851</s>
                                  </small>
                              </div>
                              <div>
                                  <a href="product.html" class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Add to cart">
                                      <i class="icon icon-cart font-size-xl"></i>
                                  </a>
                              </div>
                          </div>
                      </div>

                      <div class="card-image pb-4">
                          <a href="#">
                              <img src="{{ asset('frontend/assets/images/templates//clothing/cloth-3.jpg') }}" class="card-img-top img-hover" data-img="{{ asset('frontend/assets/images/templates//clothing/cloth-3.jpg') }}" data-img-hover="{{ asset('frontend/assets/images/templates//clothing/cloth-3a.jpg') }}" alt="...">
                          </a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-6 col-xl-3 p-1">
              <div class="wow fadeInUp" data-wow-delay=".3s">
                  <div class="card card-fill">
                      <div class="card-body p-3 p-lg-4">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h2 class="card-title mb-1 h5">
                                      <a href="product.html" class="text-dark">
                                          Mufi
                                      </a>
                                  </h2>
                                  <small class="pre-label text-muted">
                                      <span>$584</span>
                                      <s>$838</s>
                                  </small>
                              </div>
                              <div>
                                  <a href="product.html" class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Add to cart">
                                      <i class="icon icon-cart font-size-xl"></i>
                                  </a>
                              </div>
                          </div>
                      </div>

                      <div class="card-image pb-4">
                          <a href="#">
                              <img src="{{ asset('frontend/assets/images/templates//clothing/cloth-4.jpg') }}" class="card-img-top img-hover" data-img="{{ asset('frontend/assets/images/templates//clothing/cloth-4.jpg') }}" data-img-hover="{{ asset('frontend/assets/images/templates//clothing/cloth-4a.jpg') }}" alt="...">
                          </a>
                      </div>
                  </div>
              </div>
          </div>

      </div>

      <div class="text-right pt-4">
          <a href="#" class="link link-main link-dark">
            {{ (session()->get('language') == 'bangla') ? 'সংগ্রহ দেখুন' : 'View collection' }}
          </a>
      </div>
  </div>

</section>

<!-- Footer banner -->

<section class="p-0">
  <div class="position-relative">
      <div class="cover cover-overlay" style="background-image: url({{ asset('frontend/assets/images/templates//clothing/gallery-1.jpg') }});"></div>
      <div class="py-8 text-white">
          <div class="container">
              <div class="row justify-content-end">
                  <div class="col-md-6">
                    @if(session()->get('language') == 'bangla')
                        <h2 class="display-4"><strong>অন্ধকারকে</strong> চ্যালেঞ্জ করুন</h2>
                        <p>আপনার জুতা লাগান এবং ট্রেইলে যান। হাইকিং জুতা ওজন, জল সুরক্ষা, ফোস্কা প্রতিরোধ, সান্ত্বনা, স্থায়িত্ব এবং যাদের স্থিতিশীল এবং প্রতিরক্ষামূলক পথের জুতা প্রয়োজন তাদের জন্য একটি দুর্দান্ত ভারসাম্য সরবরাহ করে।</p>
                        <a href="#" class="btn btn-rounded btn-outline-light">সংগ্রহ দেখুন</a>
                    @else
                        <h2 class="display-4">Challenge the <strong>darkness</strong></h2>
                        <p>Lace up your shoes and go out on the trail. Hiking shoes offer a great balance between weight, water protection, blister prevention, comfort, durability, and traction for those who need stable and protective trail footwear</p>
                        <a href="#" class="btn btn-rounded btn-outline-light">View collection</a>
                    @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!-- Clothing categories -->

<section class="bg-light">
  <div class="container">

      <div class="wow fadeInUp" data-wow-delay=".2s">
          <div class="row py-4">
              <div class="col-lg-3 mb-4 mb-lg">
                  <h2 class="mb-0">Clothing</h2>
                  <p><a href="#" class="link link-main link-dark">Explore all categories</a></p>
              </div>
              <div class="col-lg-9">
                  <div class="row">
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">Jackets</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">Coats</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">West</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">Pullover</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">Sweatshirts</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">Hoodies</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">Wheelchairs</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-sm btn-outline-dark text-nowrap">Long sleeve shirts</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>


      <div class="wow fadeInUp" data-wow-delay=".6s">
          <hr>
          <div class="row py-4">
              <div class="col-lg-3 mb-4 mb-lg">
                  <h2 class="mb-0">Shoes</h2>
                  <p><a href="#" class="link link-main link-dark">Explore all categories</a></p>
              </div>
              <div class="col-lg-9">
                  <div class="row">
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Running shoes</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Sneaker</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Outdoor shoes</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Soccer shoes</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Indoor shoes</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Bathing shoes</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">tennis shoes</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Cycling shoes</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>


      <div class="wow fadeInUp" data-wow-delay=".8s">
          <hr>
          <div class="row py-4">
              <div class="col-lg-3 mb-4 mb-lg">
                  <h2 class="mb-0">Equipment</h2>
                  <p><a href="#" class="link link-main link-dark">Explore all categories</a></p>
              </div>
              <div class="col-lg-9">
                  <div class="row">
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Hiking</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Fitness</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Camping gear</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Running gear</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Soccer</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Cycling</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Water sports</a>
                      </div>
                      <div class="col col-lg-3 mb-3">
                          <a href="#" class="btn btn-rounded btn-block btn-outline-dark text-nowrap">Tennis</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
</section>

<!-- Newsletter -->

<section class="bg-white">
  <div class="container">
      <div class="text-center">
          <div class="wow fadeInUp" data-wow-delay=".6s">
              <div class="row justify-content-center">
                  <div class="col-md-8 text-center">
                      <h2>
                          {{ (session()->get('language') == 'bangla') ? 'নিউজলেটার সদস্যতা' : 'Subscribe to newsletter' }}
                      </h2>
                      <form class="form form-cta mt-3">
                          <div class="form-group">
                              <div class="row gutter-1">
                                  <div class="col-md-8 mb-2 mb-lg-0">
                                      <input type="email" class="form-control form-control-rounded px-3" id="exampleInputEmail1" placeholder="Insert your email">
                                  </div>
                                  <div class="col-md-4">
                                      <button type="submit" class="btn btn-outline-dark btn-rounded btn-block">
                                          {{ (session()->get('language') == 'bangla') ? 'সাবস্ক্রাইব' : 'Subscribe' }}
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<hr class="m-0">

@endsection
@extends('frontend.main_master')
@section('content')
@section('title')
    {{ (session()->get('language') == 'bangla') ? 'চেকআউট' : 'Checkout' }}
@endsection

<!-- Breadcrumbs -->
    
<header class="header header-main header-sticky bg-dark">
  <div class="pb-2 py-lg-3">
      <div class="container text-light">
          <div class="row align-items-center">
              <div class="col-lg-8">
                  <h2 class="mb-0 h4">Checkout</h2>
                  <small class="pre-label d-none d-lg-block">Cart Items</small>
              </div>
              <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                  <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</header>

<!-- SVG Divider -->

<section class="divider bg-dark">
  <svg class="svg svg-light" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1920" height="100" viewBox="0 0 1920 100" preserveAspectRatio="none meet">
      <path d="M0,11S168.915,69.242,406.27,70.7,685.853,57.593,850.4,37.207,1259.752,73.448,1517.323,70.7,1920,19.667,1920,19.667V101H0Z" transform="translate(0 -1)" />
      <path d="M1920,102.048s-89.6,137.879-398.308,19.053c-162.379-62.5-391.708,20.855-598.484,20.855-206.775,22.449-295.6-77.886-503.833-39.909C286.864,132.511,0,110.668,0,110.668v62.337H1920Z" transform="translate(0 -73.005)" fill-opacity=".2" />
      <path d="M0,102.147S407.045,189.7,555.574,121.265C717.953,58.549,760.893,69.884,840.982,85.957c188.351,79.39,348.351-56.61,532.351,70.057C1489,91.538,1920,110.8,1920,110.8v62.551H0Z" transform="translate(0 -73.347)" fill-opacity=".4" />
  </svg>
</section>

<!-- Cart -->
    
    <section class="pt-0">
    
        <!-- Checkout steps -->
        
        @include('frontend.components.checkout.checkout_steps')
    
        <!-- Cart items -->
    
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
    
                    <h2 class="pre-label font-size-base">Cart items</h2>
                    
                    @foreach ($carts as $cart)
                        <div class="bg-white shadow-sm rounded mb-3 p-3 alert alert-dismissible" role="alert">
                            <div class="row align-items-center no-gutters p-md-2">
                                <div class="col-lg-2">
                                    <img src="{{ asset($cart->options->image) }}" alt="Product Image" class="img-fluid" />
                                </div>
                                <div class="col-lg-5 pl-lg-3 mb-2 mb-lg-0">
                                    <h2 class="h5 mb-0">{{ $cart->name }}</h2>
                                    <div>
                                        <small class="text-muted">{{ $cart->options->color ? 'Color: '.`<strong>`.$cart->options->color.`</strong>,` : '' }}</small>
                                    </div>
                                    <div>
                                        <small class="text-muted">{{ $cart->options->size ? 'Size: '.`<strong>`.$cart->options->size.`</strong>` : '' }}</small>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-2">
                                </div>
                                <div class="col-6 col-lg-3 text-right">
                                    <div class="h5 mb-0"><strong>{{ $cart->subtotal }} ৳</strong></div>
                                    <small class="text-muted">{{ $cart->qty }} * <strong>{{ $cart->price }} ৳</strong></small>
                                </div>
                            </div>
                        </div>
                    @endforeach
    
                    <!-- Discount and promocode -->
    
                    <div class="bg-white shadow-sm rounded mb-3 p-3">
                        <div class="row align-items-center no-gutters p-md-2">
    
                            <div class="col-lg-7">
                                <div class="py-2">
                                    @if (Session::has('coupon'))
                                        <div class="form-group">
                                            <p class="text-success">
                                                Congratulations! You Have Got {{ Session::get('coupon')['coupon_discount'] }}% Discount on <strong>{{ Session::get('coupon')['coupon_name'] }}</strong>
                                            </p>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <p class="text-info">
                                                Check your products before continuing.
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-lg-5">
                                <div class="row no-gutters">
                                    @if (Session::has('coupon'))
                                        <div class="col-6">
                                            <b>Coupon Name</b>
                                        </div>
                                        <div class="col-6 text-right">
                                            <strong class="text-success">{{ Session::get('coupon')['coupon_name'] }}</strong>
                                        </div>
                                        <div class="col-6">
                                            <b>Sub-Total</b>
                                        </div>
                                        <div class="col-6 text-right">
                                            {{ $cartTotal }} ৳
                                        </div>
                                        <div class="col-6">
                                            <b>Discount {{ Session::get('coupon')['coupon_discount'] }}%</b>
                                        </div>
                                        <div class="col-6 text-right">
                                            {{ Session::get('coupon')['discount_amount'] }} ৳
                                        </div>
                                        <div class="col-6">
                                            <b>Vat</b>
                                        </div>
                                        <div class="col-6 text-right">
                                            $ 0.0
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <b>Sub-Total</b>
                                        </div>
                                        <div class="col-6 text-right">
                                            {{ $cartTotal }} ৳
                                        </div>
                                        <div class="col-6">
                                            <b>Vat</b>
                                        </div>
                                        <div class="col-6 text-right">
                                            $ 0.0
                                        </div>
                                    @endif
                                </div>
                            </div>
    
                        </div>
                    </div>
    
                    <!-- Total price -->
    
                    <div class="bg-white shadow-sm rounded mb-2 p-3">
                        <div class="p-md-4">
                            <div class="row no-gutters">
                                <div class="col-6">
                                    <div class="h4 mb-0">Total price</div>
                                </div>
                                <div class="col-6 text-right">
                                    <div class="h4 mb-0">
                                        @if (Session::has('coupon'))
                                            {{ Session::get('coupon')['total_amount'] }} ৳
                                        @else
                                            {{ $cartTotal }} ৳
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Buttons -->
    
                    <div class="py-3">
                        <div class="row align-items-center no-gutters">
                            <div class="col-6">
                                <a href="{{ route('my.cart') }}" class="btn btn-dark btn-primary btn-rounded px-lg-5">Back</a>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('shipping') }}" class="btn btn-primary btn-rounded px-lg-5">Next step</a>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>

@endsection
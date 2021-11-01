@extends('frontend.main_master')
@section('content')
@section('title')
    {{ (session()->get('language') == 'bangla') ? 'রিসিট' : 'Receipt' }}
@endsection

<!-- Breadcrumbs -->
    
<header class="header header-main header-sticky bg-dark">
  <div class="pb-2 py-lg-3">
      <div class="container text-light">
          <div class="row align-items-center">
              <div class="col-lg-8">
                  <h2 class="mb-0 h4">Receipt</h2>
                  <small class="pre-label d-none d-lg-block">Order confirmation</small>
              </div>
              <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                  <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Receipt</li>
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
                <div class="col-lg-10 col-xl-8">
                    
                    @if (session('message-content'))
                        <div class="alert alert-{{ session('alert') }} shadow-sm rounded alert-dismissible fade show p-3 p-lg-4 mb-5 p-md-5" role="alert">
                            <h2 class="h6 mb-0">{{ session('message-content') }}</h2>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
    
                    <!-- Receipt shipping info -->
    
                    <h2 class="pre-label font-size-base">Shipping info</h2>
    
                    <div class="bg-white shadow-sm rounded mb-3 p-3 p-md-5">
    
                        <div class="row">
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Name</small>
                                    <p>{{ $receipt['name'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Email</small>
                                    <p>{{ $receipt['email'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Phone</small>
                                    <p>{{ $receipt['phone'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Zip</small>
                                    <p>{{ $receipt['post_code'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">City</small>
                                    <p>{{ $receipt['city'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Address</small>
                                    <p>{{ $receipt['address'] }}</p>
                                </div>
                            </div>

                            <!--
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Company name</small>
                                    <p>Divano Corporation</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Company phone</small>
                                    <p>+122 333 6665</p>
                                </div>
                            </div>
                            -->
                            
                        </div>
                    </div>
    
                    <!-- Receipt Order details -->
    
                    <h2 class="pre-label font-size-base">Order details</h2>
    
                    <div class="bg-white shadow-sm rounded mb-3 p-3 p-md-5">
    
                        <div class="row">
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Order no.</small>
                                    <p>{{ $receipt['order_number'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Transaction ID</small>
                                    <p>{{ $receipt['transaction_id'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Order date</small>
                                    <p>{{ $receipt['order_date'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Shipping arrival</small>
                                    <p>{{ $receipt['arrival_date'] }}</p>
                                </div>
                            </div>
                        </div>
    
                    </div>
    
                    <!-- Receipt Payment details -->
    
                    <h2 class="pre-label font-size-base">Payment details</h2>
    
                    <div class="bg-white shadow-sm rounded mb-3 p-3 p-md-5">
    
                        <div class="row">
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Transaction time</small>
                                    <p>{{ $receipt['created_at'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Amount</small>
                                    <p>{{ $receipt['amount'] }} ৳</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Total items</small>
                                    <p>{{ $receipt['cart_qty'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Payment Method</small>
                                    <p>{{ $receipt['payment_method'] }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Status</small>
                                    <p>{{ $receipt['status'] }}</p>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="pre-label">Cart details</small>
                                    <p>**** **** **** 9656</p>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Buttons -->
    
                    <div class="py-3">
                        <div class="row align-items-center no-gutters">
                            <div class="col-6">
                                <a href="{{ route('user.order') }}" class="btn btn-dark btn-primary btn-rounded px-lg-5">Order history</a>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('user.wishlist') }}" class="btn btn-primary btn-rounded px-lg-5">My whishlist</a>
                            </div>
                        </div>
                    </div>
    
                </div>    
            </div>
        </div>
    </section>

@endsection
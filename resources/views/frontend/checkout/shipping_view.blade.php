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
                <div class="col-lg-10 col-xl-8">
    
                    <!-- Checkout registration -->

                    {{-- <form action="{{ route('checkout.store') }}" method="POST"> --}}
                    <form action="{{ route('stripe.order') }}" method="POST">
                        @csrf
                        <div class="card bg-white shadow-sm mb-2">

                            <div class="card-header py-4 bg-white">
                                <h2 class="h4 mb-0">Shipping Address</h2>
                            </div>

                            <div class="card-body p-0">
                                <hr class="m-0">
                                <div class="p-4 p-md-6">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name"><b>Name</b></label>
                                                <input name="name" id="name" type="text" value="{{ Auth::user()->name ? Auth::user()->name : '' }}" class="form-control form-control-simple" required="" placeholder="Name: *">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email"><b>Email</b></label>
                                                <input name="email" id="email" type="email" value="{{ Auth::user()->email ? Auth::user()->email : '' }}" class="form-control form-control-simple" required="" placeholder="Email: *">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phone"><b>Phone</b></label>
                                                <input name="phone" id="phone" type="text" value="{{ Auth::user()->phone ? Auth::user()->phone : '' }}" class="form-control form-control-simple" required="" placeholder="Phone: *">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="post_code"><b>Post Code</b></label>
                                                <input name="post_code" id="post_code" type="text" class="form-control form-control-simple" required="" placeholder="Post code: *">
                                                @error('post_code')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="division_id"><b>Division</b></label>
                                                <select name="division_id" id="division_id" class="custom-select" required="">
                                                    <option selected="selected" disabled="disabled" value="">Choose Division...</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('division_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="district_id"><b>District</b></label>
                                                <select name="district_id" id="district_id" class="custom-select" required="">
                                                    <option selected="selected" disabled="disabled" value="">Choose District...</option>
                                                </select>
                                                @error('district_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="state_id"><b>State</b></label>
                                                <select name="state_id" id="state_id" class="custom-select" required="">
                                                    <option selected="selected" disabled="disabled" value="">Choose State...</option>
                                                </select>
                                                @error('state_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="notes"><b>Notes</b></label>
                                                <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-12">

                                            <div class="custom-control custom-checkbox custom-checkbox-primary py-2">
                                                <input type="checkbox" class="custom-control-input" id="customExampleCheck1">
                                                <label class="custom-control-label" for="customExampleCheck1">
                                                    I have read and accepted the <a href="#">terms and conditions</a>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-checkbox custom-checkbox-primary py-2">
                                                <input type="checkbox" class="custom-control-input" id="customExampleCheck2">
                                                <label class="custom-control-label" for="customExampleCheck2">
                                                    Subscribe to exciting newsletters and great tips
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery alert -->
                        <div class="accordion" id="accordion1">
                            <div class="card card-panel alert alert-warning shadow-sm rounded mb-4 p-3 p-lg-4 mb-5 p-md-5">
    
                                <div class="card-header py-0 collapsed" role="button" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                    <h2 class="h6 mb-0"> Delivery info</h2>
                                </div>
        
                                <div id="collapseTwo1" class="collapse py-4" aria-labelledby="headingTwo" data-parent="#accordion1">
                                    <div class="">
                                        <p>
                                            A frequently overlooked, powerful fulfillment option is offering local pick-up.
                                            If you have a physical location and can allow your customers to forgo paying shipping
                                            costs altogether, you should!
                                        </p>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                        <h1 class="pre-label font-size-base">Select delivery</h1>
        
                        <!-- Delivery oneday shipping -->
        
                        <div class="accordion br-sm" id="accordionDeliveryExample">
        
                            <div class="card card-fill mb-3 shadow-sm rounded">
                                <div class="card-header p-3 p-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio">
                                                <input name="delivery_method" value="1" type="radio" id="customRadio1" name="customRadio" class="custom-control-input" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                                <label class="custom-control-label pl-2 pl-lg-4" for="customRadio1">
                                                    <span class="h5 m-0">One-day Shipping</span><br />
                                                    <small>Estimated around 24 hrs</small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="h4 m-0 pt-3 pt-lg-0">
                                                $ 199,00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse pt-0" aria-labelledby="customRadio1" data-parent="#accordionDeliveryExample">
                                    <hr class="m-0">
                                    <div class="card-body">
                                        Possimus, consectetur ullam dicta explicabo sit corrupti incidunt exercitationem optio quos doloremque neque
                                        placeat recusandae obcaecati ab quidem commodi, eaque earum unde?
                                    </div>
                                </div>
                            </div>
        
                            <!-- Delivery economy shipping -->
        
                            <div class="card card-fill mb-3 shadow-sm rounded">
                                <div class="card-header p-3 p-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio">
                                                <input name="delivery_method" value="2" type="radio" id="customRadio2" name="customRadio" class="custom-control-input" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
                                                <label class="custom-control-label pl-2 pl-lg-4" for="customRadio2">
                                                    <span class="h5 m-0">Economy Shipping</span><br />
                                                    <small>You will receive order in 1-3 days</small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="h4 m-0 pt-3 pt-lg-0">
                                                $ 99,00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseTwo" class="collapse pt-0" aria-labelledby="customRadio2" data-parent="#accordionDeliveryExample">
                                    <hr class="m-0">
                                    <div class="card-body">
                                        Incidunt exercitationem optio quos doloremque neque placeat recusandae obcaecati ab quidem commodi, eaque earum unde?
                                    </div>
                                </div>
                            </div>
        
                            <!-- Delivery free shipping -->
        
                            <div class="card card-fill mb-3 shadow-sm rounded">
                                <div class="card-header p-3 p-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio">
                                                <input name="delivery_method" value="3" type="radio" id="customRadio3" name="customRadio" class="custom-control-input" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">
                                                <label class="custom-control-label pl-2 pl-lg-4" for="customRadio3">
                                                    <span class="h5 m-0">Free shipping</span><br />
                                                    <small>Available for smaller packages</small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="h4 m-0 pt-3 pt-lg-0">
                                                Free
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseThree" class="collapse pt-0" aria-labelledby="customRadio3" data-parent="#accordionDeliveryExample">
                                    <hr class="m-0">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, consectetur ullam dicta explicabo sit corrupti incidunt
                                        exercitationem optio quos doloremque neque placeat recusandae obcaecati ab quidem commodi, eaque earum unde?
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Discount and promocode -->
        
                        <div class="bg-white shadow-sm rounded mb-3 p-3">
                            <div class="row align-items-center no-gutters p-md-2">
        
                                <div class="col-lg-12">
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
                                    <a href="{{ route('checkout') }}" class="btn btn-dark btn-primary btn-rounded px-lg-5">Back</a>
                                </div>
                                <div class="col-6 text-right">
                                    {{-- <button type="submit" class="btn btn-primary btn-rounded px-lg-5">Proceed to payment</button> --}}
                                    <button type="submit" class="btn btn-primary btn-rounded px-lg-5">Dummy payment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
    
            </div>
        </div>
    </section>

    <script>

        const getDropdownJSON = async function(url, status) {
            await fetch(url)
            .then(
                function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok!');
                    }
                    // Examine the text in the response
                    response.json().then(function(data) {
                        addDropdownData(data, status)
                    });
                }
            )
            .catch(function(err) {
                alert(err.message)
            })
        }

        
        $(document).ready(function() {
            const division_id = document.getElementById('division_id')
            const district_id = document.getElementById('district_id')
            $(division_id).on('change', function() {
                const id = $(this).val();
                if (id) {
                    getDropdownJSON("{{ url('/get/district/ajax') }}/" + id, 1)
                }
                else {
                    alert('warning')
                }
            })
            $(district_id).on('change', function() {
                const id = $(this).val();
                if (id) {
                    getDropdownJSON("{{ url('/get/state/ajax') }}/" + id, 0)
                }
                else {
                    alert('warning')
                }
            })
        })

    </script>

@endsection
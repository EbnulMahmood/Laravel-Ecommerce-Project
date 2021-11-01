@extends('frontend.main_master')
@section('content')
@section('title')
    {{ (session()->get('language') == 'bangla') ? 'আমার কার্ট' : 'My Cart' }}
@endsection

<!-- Breadcrumbs -->
    
<header class="header header-main header-sticky bg-dark">
  <div class="pb-2 py-lg-3">
      <div class="container text-light">
          <div class="row align-items-center">
              <div class="col-lg-8">
                  <h2 class="mb-0 h4">My Cart</h2>
                  <small class="pre-label d-none d-lg-block">Cart Items</small>
              </div>
              <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                  <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">My Cart</li>
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

<!-- Profile dashboard -->

<section class="pt-0">
  <div class="container">
      <div class="row justify-content-md-center">

        <!-- MyCart content -->
        <div class="col-lg-8">
    
            <h2 class="pre-label font-size-base">Cart items</h2>
            
            <div id="my-cart-items">
                <!-- my-cart items -->
            </div>

            <!-- Discount and promocode -->

            <div class="bg-white shadow-sm rounded mb-3 p-3">
                <div class="row align-items-center no-gutters p-md-2">

                    <div class="col-lg-7">
                        <div class="py-2">
                            <div id="apply-coupon-code">
                                <div class="form-group">
                                    <label>Promo code:</label>
                                    <input id="coupon-code" type="text" value="" class="form-control form-control-sm w-auto" name="couponcode" id="couponcode" placeholder="Coupon code" />
                                </div>
                                <div class="form-group">
                                    <button onclick="applyCoupon()" type="button" class="btn btn-outline-primary btn-rounded btn-sm">Apply Coupon</button>
                                </div>
                            </div>
                            <div id="apply-coupon-success"></div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div id="coupon-info" class="row no-gutters">
                            <!-- coupon content -->
                        </div>
                    </div>

                </div>
            </div>

            <!-- Total price -->

            <div class="bg-white shadow-sm rounded mb-2 p-3">
                <div class="p-md-4" id="coupon-cal-field">
                    <!-- coupon content -->
                </div>
            </div>

            <!-- Buttons -->

            <div class="py-3">
                <div class="row align-items-center no-gutters">
                    <div class="col-6">
                        <a href="{{ route('shop.product') }}" class="btn btn-dark btn-primary btn-rounded px-lg-5">Shop more</a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-rounded px-lg-5">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>

      </div>
  </div>
</section>

<script>

    const getMyCartJSON = async function(url, status = 0) {
        await fetch(url)
        .then(
            function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok!');
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    if (status === 1) {
                        getMyCartData(data)
                    }
                    else if(status === 2) {
                        incrementMyCartQtyData(data)
                    }
                    else if(status === 3) {
                        decrementMyCartQtyData(data)
                    }
                    else if(status === 4) {
                        getCouponData(data)
                    }
                    else if(status === 5) {
                        RemoveCouponData(data)
                    } else {
                        removeMyCartItemData(data)
                    }
                });
            }
        )
        .catch(function(err) {
            alert(err.message)
        })
    }

    // Example POST method implementation:
    const postCouponData = async function(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    function myCartItems() {
        getMyCartJSON("{{ url('/my-cart/data/ajax') }}", 1)
    }

    myCartItems()

    function removeMyCartItem(id) {
        getMyCartJSON("{{ url('/remove/my-cart-product/ajax') }}/" + id)
    }

    function incrementMyCartQty(id) {
        getMyCartJSON("{{ url('/increment/my-cart-qty/ajax') }}/" + id, 2)
    }

    function decrementMyCartQty(id) {
        getMyCartJSON("{{ url('/decrement/my-cart-qty/ajax') }}/" + id, 3)
    }

    const applyCoupon = function() {
        const coupon_code = $('#coupon-code').val()
        postCouponData("{{ url('/apply/coupon/ajax') }}", {
            coupon_code: coupon_code,
        })
        .then(data => {
            couponCalculation()
            getToastAlert(data)
        });
    }

    const couponCalculation = function() {
        getMyCartJSON("{{ url('/coupon/calculation/ajax') }}", 4)
    }

    const removeCoupon = function() {
        getMyCartJSON("{{ url('/remove/coupon/ajax') }}", 5)
    }

    couponCalculation()

</script>

@endsection
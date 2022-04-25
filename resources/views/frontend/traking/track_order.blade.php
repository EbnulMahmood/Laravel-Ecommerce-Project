@extends('frontend.main_master')
@section('content')
@section('title')
    {{ (session()->get('language') == 'bangla') ? 'Track My Product' : 'Track My Product' }}
@endsection

<!-- Breadcrumbs -->
    
<header class="header header-main header-sticky bg-dark">
    <div class="pb-2 py-lg-3">
        <div class="container text-light">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="mb-0 h4">My profile</h2>
                    <small class="pre-label d-none d-lg-block">User accout</small>
                </div>
                <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                    <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        <article class="card">
            <div class="card-body">
                <h6>Order ID: {{ $track->invoice_no }}</h6>
                <div class="track">
                    @if ($track->status === 'Pending')
                        <div class="step active"> <span class="icon icon-layers"></span> <span class="text">Order Pending</span> </div>
                        <div class="step"> <span class="icon icon-select"></span> <span class="text">Order Confirmed</span> </div>
                        <div class="step"> <span class="icon icon-magic-wand"></span> <span class="text">Order Processing</span> </div>
                        <div class="step"> <span class="icon icon-user"></span> <span class="text"> Picked by courier</span> </div>
                        <div class="step"> <span class="icon icon-car"></span> <span class="text">Order Shipped</span> </div>
                        <div class="step"> <span class="icon icon-gift"></span> <span class="text">Ready for pickup</span> </div>
                    @elseif ($track->status === 'Confirmed')
                        <div class="step active"> <span class="icon icon-layers"></span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon icon-select"></span> <span class="text">Order Confirmed</span> </div>
                        <div class="step"> <span class="icon icon-magic-wand"></span> <span class="text">Order Processing</span> </div>
                        <div class="step"> <span class="icon icon-user"></span> <span class="text"> Picked by courier</span> </div>
                        <div class="step"> <span class="icon icon-car"></span> <span class="text">Order Shipped</span> </div>
                        <div class="step"> <span class="icon icon-gift"></span> <span class="text">Ready for pickup</span> </div>
                    @elseif ($track->status === 'Processing')
                        <div class="step active"> <span class="icon icon-layers"></span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon icon-select"></span> <span class="text">Order Confirmed</span> </div>
                        <div class="step active"> <span class="icon icon-magic-wand"></span> <span class="text">Order Processing</span> </div>
                        <div class="step"> <span class="icon icon-user"></span> <span class="text"> Picked by courier</span> </div>
                        <div class="step"> <span class="icon icon-car"></span> <span class="text">Order Shipped</span> </div>
                        <div class="step"> <span class="icon icon-gift"></span> <span class="text">Ready for pickup</span> </div>
                    @elseif ($track->status === 'Picked')
                        <div class="step active"> <span class="icon icon-layers"></span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon icon-select"></span> <span class="text">Order Confirmed</span> </div>
                        <div class="step active"> <span class="icon icon-magic-wand"></span> <span class="text">Order Processing</span> </div>
                        <div class="step active"> <span class="icon icon-user"></span> <span class="text"> Picked by courier</span> </div>
                        <div class="step"> <span class="icon icon-car"></span> <span class="text">Order Shipped</span> </div>
                        <div class="step"> <span class="icon icon-gift"></span> <span class="text">Ready for pickup</span> </div>
                    @elseif ($track->status === 'Shipped')
                        <div class="step active"> <span class="icon icon-layers"></span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon icon-select"></span> <span class="text">Order Confirmed</span> </div>
                        <div class="step active"> <span class="icon icon-magic-wand"></span> <span class="text">Order Processing</span> </div>
                        <div class="step active"> <span class="icon icon-user"></span> <span class="text"> Picked by courier</span> </div>
                        <div class="step active"> <span class="icon icon-car"></span> <span class="text">Order Shipped</span> </div>
                        <div class="step"> <span class="icon icon-gift"></span> <span class="text">Ready for pickup</span> </div>
                    @elseif ($track->status === 'Delivered')
                        <div class="step active"> <span class="icon icon-layers"></span> <span class="text">Order Pending</span> </div>
                        <div class="step active"> <span class="icon icon-select"></span> <span class="text">Order Confirmed</span> </div>
                        <div class="step active"> <span class="icon icon-magic-wand"></span> <span class="text">Order Processing</span> </div>
                        <div class="step active"> <span class="icon icon-user"></span> <span class="text"> Picked by courier</span> </div>
                        <div class="step active"> <span class="icon icon-car"></span> <span class="text">Order Shipped</span> </div>
                        <div class="step active"> <span class="icon icon-gift"></span> <span class="text">Ready for pickup</span> </div>
                    @endif
                </div>
            </div>
        </article>
    </div>
  </section>

@endsection
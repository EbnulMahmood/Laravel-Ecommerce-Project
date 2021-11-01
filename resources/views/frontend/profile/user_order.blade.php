@extends('frontend.main_master')
@section('content')
@section('title')
    {{ (session()->get('language') == 'bangla') ? 'অর্ডারস' : 'Orders' }}
@endsection
@php
    $user = Auth::user();
@endphp

<!-- Breadcrumbs -->
    
<header class="header header-main header-sticky bg-dark">
  <div class="pb-2 py-lg-3">
      <div class="container text-light">
          <div class="row align-items-center">
              <div class="col-lg-8">
                  <h2 class="mb-0 h4">My Orders</h2>
                  <small class="pre-label d-none d-lg-block">User accout</small>
              </div>
              <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                  <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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
      <div class="row">

          <!-- Menu sidebar -->

          <div class="col-lg-3">

              <div class="br-sm pr-lg-4 mt-xl-n6">
              
                  <!-- Profile menu header -->
              
                  <div class="py-3 py-lg-4">
                      <div class="row align-items-center justify-content-center no-gutters text-lg-center">
                          <div class="col-9 col-lg-12">
                              <div class="d-flex flex-lg-column align-items-center">
                                  <div class="pr-3 pr-lg-0">
                                      <img src="{{ !empty($user->profile_photo_path) ?
                                        url($user->profile_photo_path) :
                                        url('upload/no_image.jpg') }}" alt="Profile Image" class="rounded-circle mb-lg-2 img-fluid" style="width: 50px;">
                                  </div>
                                  <div>
                                      <div class="h5 m-0">{{ $user->name }}</div>
                                      <div class="text-muted">{{ $user->email }}</div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-3 d-lg-none text-right">
                              <button class="btn btn-icon btn-primary btn-sm toggle-show" data-show="open-profile-sidebar">
                                  <i class="icon icon-text-align-center"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              
                  <!-- Profile sidebar -->
                  
                  @include('frontend.components.profile.profile_sidebar')
                  
              </div>

          </div>

          <!-- Dashboard details -->

          <div class="col-lg-9 pt-lg-4">
              
              <h2 class="pre-label font-size-base">Orders in process</h2>
                    
                    <div class="mb-3 mb-lg-5">
                        <div class="accordion br-sm" id="accordionOrdersExample">
                            
                            @forelse ($orders as $order)
                                <div class="card card-fill mb-3 shadow-sm rounded">
                                    <div class="card-header bg-white py-4 p-2 p-md-4 pointer" id="heading-{{ $order->id }}" role="button" data-toggle="collapse" data-target="#collapseOne{{ $order->id }}" aria-expanded="true" aria-controls="collapseOne{{ $order->id }}">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <i class="icon icon-tag mr-3"></i>
                                                <span>{{ $order->invoice_no }}</span>
                                            </div>
                                            <div class="col-6 col-xl-3">
                                                <i class="icon icon-clock mr-3"></i>
                                                <span>{{ Carbon\Carbon::parse($order->order_date)->toFormattedDateString() }}</span>
                                            </div>
                                            <div class="col-6 col-xl-3 text-right">
                                                <span>{{ $order->amount }} ৳</span>
                                            </div>
                                            <div class="col-xl-2 text-center pt-3 pt-xl-0">
                                                @if ($order->status === 'Pending')
                                                    <small class="p-1 bg-light-primary rounded-sm text-white btn-block text-uppercase">
                                                        Pending
                                                    </small>
                                                @elseif ($order->status === 'Canceled')
                                                    <small class="p-1 bg-light-danger rounded-sm text-white btn-block text-uppercase">
                                                        Canceled
                                                    </small>
                                                @else
                                                    <small class="p-1 bg-light-success rounded-sm text-white btn-block text-uppercase">
                                                        Delivered
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseOne{{ $order->id }}" class="collapse pt-0" aria-labelledby="heading-{{ $order->id }}" data-parent="#accordionOrdersExample">
                                        <hr class="m-0">
                                        <div class="text-left p-3">
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-icon btn-rounded btn-outline-gray" type="button" id="dropdownMenuButton-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon icon-menu text-dark"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-1">
                                                    <a href="{{ route('order.receipt', ['order_id' => $order->id]) }}" rel="noopener noreferrer" target="_blank" type="button" class="dropdown-item text-primary">
                                                        <span class="icon icon-eye"> View</span>
                                                    </a>
                                                    <a href="{{ route('download.receipt', ['order_id' => $order->id]) }}" rel="noopener noreferrer" target="_blank" type="button" class="dropdown-item text-info">
                                                        <span class="icon icon-download"> Download</span>
                                                    </a>
                                                    @if ($order->status === 'Pending')
                                                        <a href="{{ route('return.order', ['order_id' => $order->id]) }}" rel="noopener noreferrer" target="_blank" type="button" class="dropdown-item text-danger">
                                                            <span class="icon icon-warning"> Return Order</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="m-0">
                                        <div class="card-body bg-white">
                                            
                                            @php
                                                $order_items = DB::table('order_items')->where('order_id', $order->id)->get();
                                            @endphp
                                            @foreach ($order_items as $order_item)
                                                @php
                                                    $product = DB::table('products')->where('id', $order_item->product_id)->first();
                                                @endphp
                                                <div class="mb-3 mb-lg-4 bg-light shadow-sm px-4 py-3">
                                                    <div class="row align-items-center no-gutters p-md-2">
                                                        <div class="col-lg-2">
                                                            <img src="{{ asset($product->product_thumbnail) }}" class="img-fluid br-sm shadow-sm" alt="Image title">
                                                        </div>
                                                        <div class="col-lg-5 pl-lg-3 py-2 py-lg-0">
                                                            <div><strong>{{ $product->product_name_en }}</strong></div>
                                                            <div>
                                                                <small class="text-muted">{{ $order_item->color ? 'Color: '. $order_item->color : ''}}</small>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted">{{ $order_item->size ? 'Size: '. $order_item->size : ''}}</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-2">
                                                            <div><small class="pre-label">Qty</small></div>
                                                            <span>{{ $order_item->qty }}</span>
                                                        </div>
                                                        <div class="col-6 col-lg-3 text-right">
                                                            <div><small class="pre-label">Total</small></div>
                                                            <span>{{ $order_item->price * $order_item->qty }} ৳</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 col-xl-12">
                                    <div class="alert alert-info" role="alert">
                                        <strong>No Item Found!</strong>
                                    </div>
                                </div>
                            @endforelse

                            <!-- Pagination -->
                
                            <nav aria-label="Page navigation example">
                                <div class="pagination justify-content-center py-3 py-lg-4">
                                    {{ $orders->links() }}
                                </div>
                            </nav>
                    
                        </div>
                    </div>

          </div>
      </div>
  </div>
</section>

@endsection
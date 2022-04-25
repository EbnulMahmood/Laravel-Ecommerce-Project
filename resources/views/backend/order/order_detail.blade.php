@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>#{{ $order->invoice_no }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('pending.order') }}">Pending Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">#{{ $order->invoice_no }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <section class="section">
                    <div class="row" id="table-head">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Shipping Details</h4>
                                </div>
                                <div class="card-content">
                                    <!-- table head dark -->
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tr>
                                                <td class="text-bold-500">Name</td>
                                                <td>{{ $order->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Phone</td>
                                                <td>{{ $order->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Email</td>
                                                <td>{{ $order->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Division</td>
                                                <td>{{ $order->division->division_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">District</td>
                                                <td>{{ $order->district->district_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">State</td>
                                                <td>{{ $order->state->state_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Post Code</td>
                                                <td>{{ $order->post_code }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Order Date</td>
                                                <td>{{ $order->order_date }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-6 col-sm-12">
                <section class="section">
                    <div class="row" id="table-head">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Order Details</h4>
                                </div>
                                <div class="card-content">
                                    <!-- table head dark -->
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tr>
                                                <td class="text-bold-500">Name</td>
                                                <td>{{ $order->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Phone</td>
                                                <td>{{ $order->user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Email</td>
                                                <td>{{ $order->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Payment Type</td>
                                                <td>{{ $order->payment_method }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Transaction Id</td>
                                                <td>{{ $order->transaction_id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Invoice</td>
                                                <td>{{ $order->invoice_no }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Amount</td>
                                                <td>{{ $order->amount }} ৳</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Status</td>
                                                <td>{{ $order->status }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12 col-sm-12">
                <section class="section">
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Products</h4>
                                </div>
                                <div class="card-content">
                                    <!-- table bordered -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Color</th>
                                                    <th>Size</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_items as $order_item)
                                                    <tr>
                                                        <td width="10%">
                                                            <div class="avatar avatar-xl me-3">
                                                                <img src="{{ asset($order_item->product->product_thumbnail) }}" alt="" srcset="">
                                                            </div>
                                                        </td>
                                                        <td width="20%">{{ $order_item->product->product_name_en }}</td>
                                                        <td>{{ $order_item->product->product_code }}</td>
                                                        <td>{{ $order_item->color ? $order_item->color : 'Nan' }}</td>
                                                        <td>{{ $order_item->size }}</td>
                                                        <td>{{ $order_item->qty }}</td>
                                                        <td>{{ $order_item->price }} ৳</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @if ($order->return_order == 0)
                    @if ($order->status == 'Pending')
                        <a href="{{ route('pending.confirm', $order->id) }}" data-value='1' id="confirm_item" type="submit" class="btn btn-success">Confirm Order</a>
                    @elseif ($order->status == 'Confirmed')
                        <a href="{{ route('confirm.processing', $order->id) }}" data-value='2' id="confirm_item" type="submit" class="btn btn-success">Process Order</a>
                    @elseif ($order->status == 'Processing')
                        <a href="{{ route('processing.picked', $order->id) }}" data-value='3' id="confirm_item" type="submit" class="btn btn-success">Pick Order</a>
                    @elseif ($order->status == 'Picked')
                        <a href="{{ route('picked.shipped', $order->id) }}" data-value='4' id="confirm_item" type="submit" class="btn btn-success">Ship Order</a>
                    @elseif ($order->status == 'Shipped')
                        <a href="{{ route('shipped.delivered', $order->id) }}" data-value='5' id="confirm_item" type="submit" class="btn btn-success">Deliver Order</a>
                    @endif
                @elseif ($order->return_order == 1)
                    <div class="card-body">
                        <div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i> Cancel Order Requested.</div>
                    </div>
                @elseif ($order->return_order == 2)
                    <div class="card-body">
                        <div class="alert alert-danger"><i class="bi bi-file-excel"></i> Order has been Canceled.</div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

@endsection
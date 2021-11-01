<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function PendingOrder()
    {
        $orders = Order::where('status', 'Pending')->orderBy('id', 'DESC')->get();
        return view('backend.order.pending_order', compact('orders'));
    }

    public function OrderDetail($id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $id)->first();
        $order_items = OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.order.order_detail', compact('order', 'order_items'));
    }

    public function OrderDelete($id)
    {
        # code...
    }

    public function ConfirmedOrder()
    {
        $orders = Order::where('status', 'Confirmed')->orderBy('id', 'DESC')->get();
        return view('backend.order.confirmed_order', compact('orders'));
    }

    public function ProcessingOrder()
    {
        $orders = Order::where('status', 'Processing')->orderBy('id', 'DESC')->get();
        return view('backend.order.processing_order', compact('orders'));
    }

    public function PickedOrder()
    {
        $orders = Order::where('status', 'Picked')->orderBy('id', 'DESC')->get();
        return view('backend.order.picked_order', compact('orders'));
    }

    public function ShippedOrder()
    {
        $orders = Order::where('status', 'Shipped')->orderBy('id', 'DESC')->get();
        return view('backend.order.shipped_order', compact('orders'));
    }

    public function DeliveredOrder()
    {
        $orders = Order::where('status', 'Delivered')->orderBy('id', 'DESC')->get();
        return view('backend.order.delivered_order', compact('orders'));
    }

    public function CanceledOrder()
    {
        $orders = Order::where('status', 'Canceled')->orderBy('id', 'DESC')->get();
        return view('backend.order.canceled_order', compact('orders'));
    }
}

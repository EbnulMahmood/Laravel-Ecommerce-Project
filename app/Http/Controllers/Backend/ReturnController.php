<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReturnController extends Controller
{
    public function ReturnRequest()
    {
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.return_request', compact('orders'));
    }

    public function ReturnApprove($id)
    {
        Order::where('id', $id)->update([
            'return_order' => 2,
            'status' => 'Canceled',
        ]);

        $notification = AlertMessage('Order Canceled successfully', 'success');
        return Redirect()->back()->with($notification);
    }

    public function CanceledOrder()
    {
        $orders = Order::where('status', 'Canceled')->orderBy('id', 'DESC')->get();
        return view('backend.order.canceled_order', compact('orders'));
    }
}

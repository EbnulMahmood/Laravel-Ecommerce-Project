<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use Auth;

class UserController extends Controller
{
    private function Receipt($order_id) {

        $invoice = Order::findOrFail($order_id);

        if ($invoice->delivery_method == 1) {
            $arrival_date = Carbon::parse($invoice->order_date)
            ->addDays(1)
            ->format('d F Y');
        } else if ($invoice->delivery_method == 2) {
            $arrival_date = Carbon::parse($invoice->order_date)
            ->addDays(3)
            ->format('d F Y');
        } else {
            $arrival_date = Carbon::parse($invoice->order_date)
            ->addDays(7)
            ->format('d F Y');
        } 

        return [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $invoice->amount,
            'address' => $invoice->state->state_name,
            'city' => $invoice->district->district_name.', '. 
                      $invoice->division->division_name,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'post_code' => $invoice->post_code,
            'order_number' => $invoice->order_number,
            'transaction_id' => $invoice->transaction_id,
            'order_date' => $invoice->order_date,
            'arrival_date' => $arrival_date,
            'payment_method' => $invoice->payment_method,
            'status' => $invoice->status,
            'cart_qty' => $invoice->cart_qty,
            'created_at' => Carbon::parse($invoice->created_at)->toDayDateTimeString(),
        ];
    }

    public function UserOrder()
    {
        $num_items = 5;
        $orders = Order::where('user_id', Auth::id())->where('status','!=','Canceled')->orderBy('id', 'DESC')->paginate($num_items);
        return view('frontend.profile.user_order', compact('orders'));
    }

    public function ReturnOrder($order_id)
    {
        $receipt = UserController::Receipt($order_id);        
        return view('frontend.checkout.order_return', compact('receipt', 'order_id'));
    }

    public function CancelOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);
        $notification = AlertMessage('Cancel request send successfully', 'success');
        return Redirect()->route('user.order')->with($notification);
    }

    public function ReturnOrderList()
    {
        $num_items = 5;
        $orders = Order::where('user_id', Auth::id())->where('status', '!=', 'Canceled')->where('return_reason','!=',NULL)->orderBy('id', 'DESC')->paginate($num_items);
        return view('frontend.profile.user_return_order', compact('orders'));
    }

    public function CanceledList()
    {
        $num_items = 5;
        $orders = Order::where('user_id', Auth::id())->where('status', 'Canceled')->orderBy('id', 'DESC')->paginate($num_items);
        return view('frontend.profile.user_canceled_order', compact('orders'));
    }

    public function OrderTraking(Request $request)
    {
        $track = Order::where('invoice_no', $request->code)->first();
        if ($track) {
            return view('frontend.traking.track_order', compact('track'));
        } else {
            $notification = AlertMessage('Invalid invoice code!', 'error');
        }
        return Redirect()->back()->with($notification);
    }
}

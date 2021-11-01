<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderMail;
use PDF;
use Auth;

class StripeController extends Controller
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

    public function StripeOrder(Request $request)
    {
        $total_amount = Session::has('coupon') ? 
        Session::get('coupon')['total_amount'] : 
        round(Cart::total());

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'cart_qty' => Cart::count(),
            'delivery_method' => $request->delivery_method,
            'payment_type' => 'Dummy',
            'payment_method' => 'Dummy',
            'transaction_id' => uniqid('dummy-id', true),
            'currency' => 'BDT',
            'amount' => $total_amount,
            'order_number' => uniqid('dummy-id'),
            'invoice_no' => 'DUMMY-INVOICE'.mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();

        $receipt = StripeController::Receipt($order_id);

        Mail::to($receipt['email'])->send(new OrderMail($receipt));

        $notification = AlertMessage('Order placed successfully!', 'success');
        
        return Redirect()->route('order.receipt', [ 'order_id' => $order_id ])
        ->with($notification)
        ->with('alert', 'success')
        ->with('message-content', 'Order #'.$receipt['order_number']
               .' was successfully placed. An email was sent with invoice to '
               .$receipt['email']);
    }

    public function OrderReceipt($order_id)
    {
        $receipt = StripeController::Receipt($order_id);        
        return view('frontend.checkout.order_receipt', compact('receipt'));
    }

    public function DownloadReceipt($order_id)
    {
        $receipt = StripeController::Receipt($order_id);
        $order_items = OrderItem::where('order_id', $order_id)->with('product')->get();
        $pdf = PDF::loadView('frontend.checkout.download_receipt', compact('receipt', 'order_items'))
                ->setPaper('a4')
                ->setOptions([
                    'tempDir' => public_path(),
                    'chroot' => public_path(),
                ]);
        return $pdf->download($receipt['invoice_no'].'.pdf');
    }

    public function ReturnOrder($order_id)
    {
        $receipt = StripeController::Receipt($order_id);        
        return view('frontend.checkout.order_return', compact('receipt'));
    }
}

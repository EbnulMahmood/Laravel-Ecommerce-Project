<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use PDF;
use DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function PendingOrder()
    {
        $orders = Order::where('status', 'Pending')->where('return_order', 0)->orderBy('id', 'DESC')->get();
        return view('backend.order.pending_order', compact('orders'));
    }

    public function OrderDetail($id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $id)->first();
        $order_items = OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.order.order_detail', compact('order', 'order_items'));
    }

    public function ConfirmedOrder()
    {
        $orders = Order::where('status', 'Confirmed')->where('return_order', 0)->orderBy('id', 'DESC')->get();
        return view('backend.order.confirmed_order', compact('orders'));
    }

    public function ProcessingOrder()
    {
        $orders = Order::where('status', 'Processing')->where('return_order', 0)->orderBy('id', 'DESC')->get();
        return view('backend.order.processing_order', compact('orders'));
    }

    public function PickedOrder()
    {
        $orders = Order::where('status', 'Picked')->where('return_order', 0)->orderBy('id', 'DESC')->get();
        return view('backend.order.picked_order', compact('orders'));
    }

    public function ShippedOrder()
    {
        $orders = Order::where('status', 'Shipped')->where('return_order', 0)->orderBy('id', 'DESC')->get();
        return view('backend.order.shipped_order', compact('orders'));
    }

    public function DeliveredOrder()
    {
        $orders = Order::where('status', 'Delivered')->where('return_order', 0)->orderBy('id', 'DESC')->get();
        return view('backend.order.delivered_order', compact('orders'));
    }

    public function PendingToConfirm($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'Confirmed',
        ]);
        $notification = AlertMessage('Order confirmed successfully!', 'success');
        return Redirect()->route('pending.order')->with($notification);
    }

    public function ConfirmToProcessing($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'Processing',
        ]);
        $notification = AlertMessage('Order processing successfully!', 'success');
        return Redirect()->route('confirmed.order')->with($notification);
    }

    public function ProcessingToPicked($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'Picked',
        ]);
        $notification = AlertMessage('Order picked successfully!', 'success');
        return Redirect()->route('processing.order')->with($notification);
    }

    public function PickedToShipped($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'Shipped',
        ]);
        $notification = AlertMessage('Order shipped successfully!', 'success');
        return Redirect()->route('picked.order')->with($notification);
    }

    public function ShippedToDelivered($id)
    {
        $products = OrderItem::where('order_id', $id)->get();
        foreach($products as $product) {
            Product::where('id', $product->product_id)->update([
                'product_qty' => DB::raw('product_qty-' . $product->qty),
            ]);
        }
        Order::findOrFail($id)->update([
            'status' => 'Delivered',
        ]);
        $notification = AlertMessage('Order delivered successfully!', 'success');
        return Redirect()->route('shipped.order')->with($notification);
    }

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

    public function DownloadInvoice($id)
    {
        $receipt = OrderController::Receipt($id);
        $order_items = OrderItem::where('order_id', $id)->with('product')->get();
        $pdf = PDF::loadView('backend.order.order_invoice', compact('receipt', 'order_items'))
                ->setPaper('a4')
                ->setOptions([
                    'tempDir' => public_path(),
                    'chroot' => public_path(),
                ]);
        return $pdf->download($receipt['invoice_no'].'.pdf');
    }
}

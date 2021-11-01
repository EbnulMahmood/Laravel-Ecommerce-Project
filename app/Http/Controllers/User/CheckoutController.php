<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Division;
use App\Models\District;
use App\Models\State;
use Auth;

class CheckoutController extends Controller
{
    public function CreateCheckout()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal'));
            } else {
                $notification = AlertMessage('Your Cart is empty', 'warning');
                return Redirect()->route('shop.product')->with($notification);
            }
            
        } else {
            $notification = AlertMessage('You\'re not logged in', 'warning');
            return Redirect()->route('login')->with($notification);
        }
    }

    public function ShippingInfo()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $cartTotal = Cart::total();
                $divisions = Division::orderBy('division_name', 'ASC')->get();
                return view('frontend.checkout.shipping_view', compact('cartTotal', 'divisions'));
            } else {
                $notification = AlertMessage('Your Cart is empty', 'warning');
                return Redirect()->back()->with($notification);
            }
            
        } else {
            $notification = AlertMessage('You\'re not logged in', 'warning');
            return Redirect()->route('login')->with($notification);
        }
    }

    public function GetDistrictAJAX($id)
    {
        $districts = District::where('division_id', $id)->orderBy('district_name', 'ASC')->get();
        return json_decode($districts);
    }
    
    public function GetStateAJAX($id)
    {
        $states = State::where('district_id', $id)->orderBy('state_name', 'ASC')->get();
        return json_decode($states);
    }

    // public function StoreCheckout(Request $request)
    // {
    //     $cartTotal = Cart::total();

    //     $data = array();
    //     $data['shipping_name'] = $request->shipping_name;
    //     $data['shipping_email'] = $request->shipping_email;
    //     $data['shipping_phone'] = $request->shipping_phone;
    //     $data['post_code'] = $request->post_code;
    //     $data['division_id'] = $request->division_id;
    //     $data['district_id'] = $request->district_id;
    //     $data['state_id'] = $request->state_id;
    //     $data['notes'] = $request->notes;
    //     $data['shipping_delivery'] = $request->shipping_delivery;

    //     return view('frontend.checkout.payment_view', compact('data', 'cartTotal'));
    // }
}

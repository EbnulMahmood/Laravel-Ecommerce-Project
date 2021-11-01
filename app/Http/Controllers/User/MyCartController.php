<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use Carbon\Carbon;
use Auth;

class MyCartController extends Controller
{
    public function MyCart()
    {
        return view('frontend.mycart.view_mycart');
    }

    public function MyCartAJAX()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }

    public function RemoveMyCartProductAJAX($id)
    {
        Cart::remove($id);
        if (Cart::count() <= 0) {
            Session::forget('coupon');
        }
        else if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }
        return response()->json(['success' => 'Removed from Cart']);
    }

    public function incrementMyCartQtyAJAX($id)
    {
        $item = Cart::get($id);
        Cart::update($id, $item->qty + 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }
        return response()->json(['success' => 'Increased Product Quantity']);
    }

    public function decrementMyCartQtyAJAX($id)
    {
        $item = Cart::get($id);
        Cart::update($id, $item->qty - 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }
        return response()->json(['success' => 'Decreased Product Quantity']);
    }

    public function ApplyCouponAJAX(Request $request)
    {
        $coupon = Coupon::where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->where('coupon_name', $request->coupon_code)->first();
        if (Cart::total() > 0) {
            if ($coupon) {
                Session::put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                    'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
                ]);
                return response()->json(['success' => 'Coupon Applied Successfully']);
            } else {
                return response()->json(['error' => 'Invalid Coupon Code!']);
            }
        } else {
            return response()->json(['error' => 'Your Cart is empty']);
        }
    }

    public function CouponCalculationAJAX()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => Session()->get('coupon')['coupon_name'],
                'coupon_discount' => Session()->get('coupon')['coupon_discount'],
                'discount_amount' => Session()->get('coupon')['discount_amount'],
                'total_amount' => Session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }   
    }

    public function RemoveCouponAJAX()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully!']);
    }
}

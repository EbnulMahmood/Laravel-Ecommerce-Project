<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class UserController extends Controller
{
    public function UserOrder()
    {
        $num_items = 5;
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate($num_items);
        return view('frontend.profile.user_order', compact('orders'));
    }
}

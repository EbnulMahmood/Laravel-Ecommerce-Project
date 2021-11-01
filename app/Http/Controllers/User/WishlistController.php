<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Carbon\Carbon;
use Auth;

class WishlistController extends Controller
{
    public function AddToWhishlistAJAX(Request $request, $id)
    {
        if (Auth::check()) {
            $exist = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();
            if (!$exist) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Added to wishlist']);
            }
            return response()->json(['info' => 'Already in wishlist']);
        } else {
            return response()->json(['error' => 'You\'re not logged in']);
        }
    }

    public function UserWishlist()
    {
        return view('frontend.wishlist.user_wishlist');
    }

    public function UserWishlistAJAX()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($wishlists);
    }

    public function RemoveWishlistProductAJAX($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Removed from Wishlist']);
    }
}

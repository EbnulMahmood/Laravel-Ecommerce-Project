<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Image;
use Auth;

class IndexController extends Controller
{
    public function Index()
    {
        $topcategories_limit = 3;
        $categories_limit = 8;
        $products_limit = 8;
        $topcategories = DB::table('categories')->orderBy('category_name_en', 'ASC')->limit($topcategories_limit)->get();
        $categories = DB::table('categories')->orderBy('category_name_en', 'ASC')->limit($categories_limit)->get();
        $featured_products = DB::table('products')->where('featured', 1)->where('status', 1)->limit($products_limit)->orderBy('id', 'DESC')->get();
        return view('frontend.index', compact('topcategories', 'categories', 'featured_products'));
    }

    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile()
    {
        $user = User::find(Auth::user()->id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $upload_location = 'upload/user_images/';

            $image_name = hexdec(uniqid()).'.'.strtolower($file->getClientOriginalExtension());
            $last_image = $upload_location.$image_name;
            if (!empty($request->old_image)) {
                unlink($request->old_image);
            }
            Image::make($file)->resize(400, 400)->save($last_image);

            $data->profile_photo_path = $last_image;
        }

        $notification = AlertMessage('Profile updated successfully!', 'success');
        $data->save();
        
        return Redirect()->route('dashboard')->with($notification);
    }

    public function ChangePassword()
    {
        return view('frontend.profile.change_password');
    }

    public function UserUpdatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('user.logout');
        } else {
            return Redirect()->back();
        }
    }

    public function SearchProduct(Request $request)
    {
        $num_page = 5;
        $products = Product::query()
            ->where('status', 1)
            ->where('product_name_en', 'LIKE', "%{$request->search}%")
            ->orWhere('short_descp_en', 'LIKE', "%{$request->search}%")
            ->orWhere('long_descp_en', 'LIKE', "%{$request->search}%")
            ->orderBy('id', 'DESC')
            ->paginate($num_page);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        
        return view('frontend.shop.shop', compact('products', 'categories'));
    }
}

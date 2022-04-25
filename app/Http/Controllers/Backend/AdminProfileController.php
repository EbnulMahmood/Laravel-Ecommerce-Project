<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Image;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $adminData = Admin::find(1);
        return view('admin.profile.admin_profile_view', compact('adminData'));
    }
    
    public function AdminProfileEdit()
    {
        $editData = Admin::find(1);
        return view('admin.profile.admin_profile_edit', compact('editData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;
        
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $upload_location = 'upload/admin_images/';

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
        
        return Redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.profile.admin_chnage_password');
    }

    public function AdminUpdatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (Hash::check($request->current_password, Admin::find(1)->password)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return Redirect()->route('admin.logout');
        } else {
            return Redirect()->back();
        }
    }

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.user.all_users', compact('users'));
    }
}

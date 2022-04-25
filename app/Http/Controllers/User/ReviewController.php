<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class ReviewController extends Controller
{
    public function ReviewStore(Request $request)
    {
        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
            'rateInput' => 'required',
        ], [
            'summary.required' => 'Enter summary.',
            'comment.required' => 'Enter comment.',
            'rateInput.required' => 'Enter rating.',
        ]);

        Review::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'rate' => $request->rateInput,
            'created_at' => Carbon::now(),
        ]);

        $notification = AlertMessage('Waiting for admin approval!', 'info');
        return Redirect()->back()->with($notification);
    }

    public function PendingReview()
    {
        $reviews = Review::orderBy('id', 'DESC')->get();
        return view('backend.review.pending_review', compact('reviews'));
    }

    public function UserDetails($id)
    {
        $user = User::where('id', $id)->first();
        return view('backend.user.user_profile_view', compact('user'));
    }

    public function ReviewActive($id)
    {
        Review::findOrFail($id)->update([
            'status' => 1,
        ]);
        $notification = AlertMessage('Review activated successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function ReviewInactive($id)
    {
        Review::findOrFail($id)->update([
            'status' => 0,
        ]);
        $notification = AlertMessage('Review inactivated successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }
}

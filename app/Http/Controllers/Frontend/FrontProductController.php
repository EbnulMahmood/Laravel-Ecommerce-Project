<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MultiImage;
use App\Models\Review;

class FrontProductController extends Controller
{
    public function ProductDetails($id, $slug)
    {
        $products_limit = 12;
        $product = Product::findOrFail($id);
        $product_color_en = explode(',', $product->product_color_en);
        $product_color_bn = explode(',', $product->product_color_bn);
        $product_size_en = explode(',', $product->product_size_en);
        $product_size_bn = explode(',', $product->product_size_bn);
        $multi_images = MultiImage::where('product_id', $id)->get();
        $related_products = Product::where('category_id', $product->category_id)->where('status', 1)
        ->where('id', '!=', $id)->limit($products_limit)->orderBy('id', 'DESC')->get();
        $num_page = 5;
        $reviews = Review::where('product_id', $id)->with('user', 'product')->where('status', 1)->latest()->paginate($num_page);
        $all_reviews = Review::where('product_id', $id)->with('user', 'product')->where('status', 1)->latest()->get();
        $total_reviews = count($all_reviews);
        $avg_review = 0;
        $one_stat = 0;
        $two_stat = 0;
        $three_stat = 0;
        $four_stat = 0;
        $five_stat = 0;
        $one_stat_avg = 0;
        $two_stat_avg = 0;
        $three_stat_avg = 0;
        $four_stat_avg = 0;
        $five_stat_avg = 0;
        if ($total_reviews > 0) {
            foreach($all_reviews as $review) {
                if ($review->rate === 5) {
                    $five_stat++;
                } elseif ($review->rate === 4) {
                    $four_stat++;
                } elseif ($review->rate === 3) {
                    $three_stat++;
                } elseif ($review->rate === 2) {
                    $two_stat++;
                } elseif ($review->rate === 1) {
                    $one_stat++;
                }
            }
            $avg_review = (5*$five_stat + 4*$four_stat + 3*$three_stat + 2*$two_stat + 1*$one_stat) / $total_reviews;
            $one_stat_avg = ($one_stat/$total_reviews)*100;
            $two_stat_avg = ($two_stat/$total_reviews)*100;
            $three_stat_avg = ($three_stat/$total_reviews)*100;
            $four_stat_avg = ($four_stat/$total_reviews)*100;
            $five_stat_avg = ($five_stat/$total_reviews)*100;
        }
        return view('frontend.product.product_details', compact('product', 'multi_images', 'reviews',
         'total_reviews', 'one_stat', 'two_stat', 'three_stat', 'four_stat', 'five_stat',
        'one_stat_avg', 'two_stat_avg', 'three_stat_avg', 'four_stat_avg', 'five_stat_avg', 'avg_review',
        'product_color_en', 'product_color_bn', 'product_size_en', 'product_size_bn', 'related_products'));
    }

    public function ProductDetailsModalAJAX($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);
        $product_color_en = explode(',', $product->product_color_en);
        $product_size_en = explode(',', $product->product_size_en);

        return response()->json(array(
            'product' => $product,
            'product_color_en' => $product_color_en,
            'product_size_en' => $product_size_en,
        ));
    }
}

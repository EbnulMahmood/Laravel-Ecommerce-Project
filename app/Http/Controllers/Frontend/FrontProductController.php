<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MultiImage;

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

        return view('frontend.product.product_details', compact('product', 'multi_images',
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

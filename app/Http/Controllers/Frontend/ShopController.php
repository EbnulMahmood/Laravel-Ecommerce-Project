<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class ShopController extends Controller
{
    public function ShopProduct()
    {
        $num_page = 6;
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->paginate($num_page);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.shop.shop', compact('products', 'categories'));
    }

    public function ShopCategory($id = NULL, $slug = NULL)
    {
        $num_page = 2;
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->paginate($num_page);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.shop.shop', compact('products', 'categories'));
    }

    public function ShopSubCategory($id = NULL, $slug = NULL)
    {
        $num_page = 2;
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->paginate($num_page);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.shop.shop', compact('products', 'categories'));
    }
}

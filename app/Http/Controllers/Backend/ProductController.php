<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\SUbCategory;
use App\Models\SUbSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImage;
use Image;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function StoreProduct(Request $request)
    {
        if ($request->file('product_thumbnail')) {
            $file = $request->file('product_thumbnail');
            $upload_location = 'upload/products/thumbnail/';

            $image_name = hexdec(uniqid()).'.'.strtolower($file->getClientOriginalExtension());
            $image_url = $upload_location.$image_name;
            Image::make($file)->resize(630, 800)->save($image_url);
        }

        Product::insert([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_bn' => str_replace(' ', '-', $request->product_name_bn),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,
            'product_thumbnail' => $image_url,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = AlertMessage('Product inserted successfully!', 'success');
        
        return Redirect()->route('manage.product')->with($notification);
    }

    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function ProductEdit($id)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $multiimages = MultiImage::where('product_id', $id)->get();
        $product = Product::findOrFail($id);

        return view('backend.product.product_edit', compact('product', 'multiimages', 'brands', 'categories', 'subcategories', 'subsubcategories'));
    }

    public function AddMultiImage($id)
    {
        $product = Product::findOrFail($id);
        $multiimages = MultiImage::where('product_id', $id)->get();
        return view('backend.product.add_multi_image', compact('product', 'multiimages'));
    }

    public function StoreMultiImage(Request $request, $id)
    {
        if ($request->file('multi_image')) {
            $images = $request->file('multi_image');
            foreach ($images as $image) {
                $upload_location = 'upload/products/multi_images/';
    
                $multi_image_name = hexdec(uniqid()).'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_url = $upload_location.$multi_image_name;
                Image::make($image)->resize(630, 800)->save($multi_image_url);

                MultiImage::insert([
                    'product_id' => $id,
                    'photo_name' => $multi_image_url,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $notification = AlertMessage('Multiple Images inserted successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function UpdateMultiImage(Request $request)
    {
        $images = $request->file('multi_image');
        foreach ($images as $id => $image) {
            $old_image = MultiImage::findOrFail($id);
            if (!empty($old_image->photo_name)) {
                unlink($old_image->photo_name);
            }
            $upload_location = 'upload/products/multi_images/';

            $multi_image_name = hexdec(uniqid()).'.'.strtolower($image->getClientOriginalExtension());
            $multi_image_url = $upload_location.$multi_image_name;
            Image::make($image)->resize(630, 800)->save($multi_image_url);

            MultiImage::findOrFail($id)->update([
                'photo_name' => $multi_image_url,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = AlertMessage('Multiple Images updated successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function ProductUpdate(Request $request, $id)
    {
        if ($request->file('product_thumbnail')) {
            $file = $request->file('product_thumbnail');
            $upload_location = 'upload/products/thumbnail/';
            if (!empty($request->old_image)) {
                unlink($request->old_image);
            }

            $image_name = hexdec(uniqid()).'.'.strtolower($file->getClientOriginalExtension());
            $image_url = $upload_location.$image_name;
            Image::make($file)->resize(630, 800)->save($image_url);
            
            Product::findOrFail($id)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name_en' => $request->product_name_en,
                'product_name_bn' => $request->product_name_bn,
                'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_bn' => str_replace(' ', '-', $request->product_name_bn),
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags_en' => $request->product_tags_en,
                'product_tags_bn' => $request->product_tags_bn,
                'product_size_en' => $request->product_size_en,
                'product_size_bn' => $request->product_size_bn,
                'product_color_en' => $request->product_color_en,
                'product_color_bn' => $request->product_color_bn,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_descp_en' => $request->short_descp_en,
                'short_descp_bn' => $request->short_descp_bn,
                'long_descp_en' => $request->long_descp_en,
                'long_descp_bn' => $request->long_descp_bn,
                'product_thumbnail' => $image_url,
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Product::findOrFail($id)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name_en' => $request->product_name_en,
                'product_name_bn' => $request->product_name_bn,
                'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_bn' => str_replace(' ', '-', $request->product_name_bn),
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags_en' => $request->product_tags_en,
                'product_tags_bn' => $request->product_tags_bn,
                'product_size_en' => $request->product_size_en,
                'product_size_bn' => $request->product_size_bn,
                'product_color_en' => $request->product_color_en,
                'product_color_bn' => $request->product_color_bn,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_descp_en' => $request->short_descp_en,
                'short_descp_bn' => $request->short_descp_bn,
                'long_descp_en' => $request->long_descp_en,
                'long_descp_bn' => $request->long_descp_bn,
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = AlertMessage('Product updated successfully!', 'success');
        
        return Redirect()->route('manage.product')->with($notification);
    }

    public function DeleteMultiImage($id)
    {
        $old_image = MultiImage::findOrFail($id);
        if (!empty($old_image->photo_name)) {
            unlink($old_image->photo_name);
        }

        MultiImage::findOrFail($id)->delete();
        $notification = AlertMessage('Image deleted successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);
        $notification = AlertMessage('Product activated successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);
        $notification = AlertMessage('Product inactivated successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        if (!empty($product->product_thumbnail)) {
            unlink($product->product_thumbnail);
        }
        Product::findOrFail($id)->delete();

        $multiimages = MultiImage::where('product_id', $id)->get();
        foreach ($multiimages as $multiimage) {
            if (!empty($multiimage->photo_name)) {
                unlink($multiimage->photo_name);
                MultiImage::where('product_id', $id)->delete();
            }
        }
        $notification = AlertMessage('Product deleted successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }
}

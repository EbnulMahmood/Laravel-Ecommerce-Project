<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_bn' => 'required',
            'brand_image' => 'required',
        ], [
            'brand_name_en.required' => 'Enter engilsh name.',
            'brand_name_bn.required' => 'Enter bangla name.',
        ]);
        
        if ($request->file('brand_image')) {
            $file = $request->file('brand_image');
            $upload_location = 'upload/brand/';

            $image_name = hexdec(uniqid()).'.'.strtolower($file->getClientOriginalExtension());
            $image_url = $upload_location.$image_name;
            if (!empty($request->old_image)) {
                unlink($request->old_image);
            }
            Image::make($file)->resize(400, 400)->save($image_url);
        }

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_bn' => $request->brand_name_bn,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
            'brand_image' => $image_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = AlertMessage('Brand inserted successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function BrandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request, $id)
    {
        if ($request->file('brand_image')) {
            $file = $request->file('brand_image');
            $upload_location = 'upload/brand/';

            $image_name = hexdec(uniqid()).'.'.strtolower($file->getClientOriginalExtension());
            $image_url = $upload_location.$image_name;
            if (!empty($request->old_image)) {
                unlink($request->old_image);
            }
            Image::make($file)->resize(400, 400)->save($image_url);

            Brand::findOrFail($id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_bn' => $request->brand_name_bn,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
                'brand_image' => $image_url,
            ]);
        } else {
            Brand::findOrFail($id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_bn' => $request->brand_name_bn,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
            ]);
        }
        $notification = AlertMessage('Brand updated successfully!', 'success');
        
        return Redirect()->route('all.brand')->with($notification);
    }

    public function BrandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        if (!empty($brand->brand_image)) {
            unlink($brand->brand_image);
        }
        Brand::findOrFail($id)->delete();
        $notification = AlertMessage('Brand deleted successfully!', 'success');
        
        return Redirect()->route('all.brand')->with($notification);
    }
}

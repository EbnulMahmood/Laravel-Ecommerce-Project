<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    public function CategoryStore(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name_en.required' => 'Enter engilsh name.',
            'category_name_bn.required' => 'Enter bangla name.',
        ]);
        
        if ($request->file('category_icon')) {
            $file = $request->file('category_icon');
            $upload_location = 'upload/category/';

            $image_name = hexdec(uniqid()).'.'.strtolower($file->getClientOriginalExtension());
            $image_url = $upload_location.$image_name;
            if (!empty($request->old_image)) {
                unlink($request->old_image);
            }
            Image::make($file)->resize(400, 400)->save($image_url);
        }

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_bn' => $request->category_name_bn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_bn' => str_replace(' ', '-', $request->category_name_bn),
            'category_icon' => $image_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = AlertMessage('Category inserted successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request, $id)
    {
        if ($request->file('category_icon')) {
            $file = $request->file('category_icon');
            $upload_location = 'upload/category/';

            $image_name = hexdec(uniqid()).'.'.strtolower($file->getClientOriginalExtension());
            $image_url = $upload_location.$image_name;
            if (!empty($request->old_image)) {
                unlink($request->old_image);
            }
            Image::make($file)->resize(400, 400)->save($image_url);

            Category::findOrFail($id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_bn' => str_replace(' ', '-', $request->category_name_bn),
                'category_icon' => $image_url,
            ]);
        } else {
            Category::findOrFail($id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_bn' => str_replace(' ', '-', $request->category_name_bn),
            ]);
        }
        $notification = AlertMessage('Category updated successfully!', 'success');
        
        return Redirect()->route('all.category')->with($notification);
    }

    public function CategoryDelete($id)
    {
        $category = Category::findOrFail($id);
        if (!empty($category->category_icon)) {
            unlink($category->category_icon);
        }
        Category::findOrFail($id)->delete();
        $notification = AlertMessage('Category deleted successfully!', 'success');
        
        return Redirect()->route('all.category')->with($notification);
    }
}

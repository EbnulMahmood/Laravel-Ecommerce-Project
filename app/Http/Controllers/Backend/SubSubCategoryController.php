<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use Illuminate\Support\Carbon;

class SubSubCategoryController extends Controller
{
    public function AllSubSubCategory()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.subsubcategory.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }

    public function GetSubCategoryAJAX($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcategories);
    }

    public function GetSubSubCategoryAJAX($subcategory_id)
    {
        $subsubcategories = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcategories);
    }

    public function SubSubCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_bn' => 'required',
        ], [
            'category_id.required' => 'Select category.',
            'subcategory_id.required' => 'Select subcategory.',
            'subsubcategory_name_en.required' => 'Enter engilsh name.',
            'subsubcategory_name_bn.required' => 'Enter bangla name.',
        ]);
        
        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_bn' => str_replace(' ', '-', $request->subsubcategory_name_bn),
            'created_at' => Carbon::now(),
        ]);

        $notification = AlertMessage('Child subcategory inserted successfully!', 'success');
        
        return Redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);
        return view('backend.subsubcategory.sub_subcategory_edit', compact('subsubcategory', 'categories', 'subcategories'));
    }

    public function SubSubCategoryUpdate(Request $request, $id)
    {
        SubSubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_bn' => str_replace(' ', '-', $request->subsubcategory_name_bn),
        ]);
        $notification = AlertMessage('Child subcategory updated successfully!', 'success');
        
        return Redirect()->route('all.subsubcategory')->with($notification);
    }

    public function SubSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();
        $notification = AlertMessage('Child subcategory deleted successfully!', 'success');
        
        return Redirect()->route('all.subsubcategory')->with($notification);
    }
}

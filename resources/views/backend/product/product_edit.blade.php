@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Product</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('manage.product') }}">Manage Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Product</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype= "multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Name (English)</h6>
                                            <input value="{{ $product->product_name_en ? $product->product_name_en : '' }}" name="product_name_en" type="text" class="form-control" required id="basicInput4" placeholder="Enter Product English Name">
                                            @error('product_name_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>নাম (Bangla)</h6>
                                            <input value="{{ $product->product_name_bn ? $product->product_name_bn : '' }}" name="product_name_bn" type="text" class="form-control" required id="basicInput5" placeholder="Enter Product Bangla Name">
                                            @error('product_name_bn')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Code</h6>
                                            <input value="{{ $product->product_code ? $product->product_code : '' }}" name="product_code" type="text" class="form-control" required id="basicInput8" placeholder="Enter Product Code">
                                            @error('product_code')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Quantity</h6>
                                            <input value="{{ $product->product_qty ? $product->product_qty : '' }}" name="product_qty" type="text" class="form-control" required id="basicInput9" placeholder="Enter Product Quantity">
                                            @error('product_qty')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Selling Price</h6>
                                            <input value="{{ $product->selling_price ? $product->selling_price : '' }}" name="selling_price" type="text" class="form-control" required id="basicInput4" placeholder="Enter Product Selling Price">
                                            @error('selling_price')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Discount Price</h6>
                                            <input value="{{ $product->discount_price ? $product->discount_price : '' }}" name="discount_price" type="text" class="form-control" id="basicInput5" placeholder="Enter Product Discount Price">
                                            @error('discount_price')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                        <h6>Brand</h6>
                                            <select class="choices form-select" required name="brand_id">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $brand->id === $product->brand_id ?
                                                    'selected' : '' }}>{{ $brand->brand_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                        <h6>Category</h6>
                                            <select id="category_id" class="choices form-select" required name="category_id">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id === $product->category_id ?
                                                        'selected' : '' }}>{{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                        <h6>Parent Category</h6>
                                            <select id="subcategory_id" class="choices form-select" required name="subcategory_id">
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id === $product->subcategory_id ?
                                                        'selected' : '' }}>{{ $subcategory->subcategory_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                        <h6>Child Category</h6>
                                            <select id="subsubcategory_id" class="choices form-select" required name="subsubcategory_id">
                                                @foreach ($subsubcategories as $subsubcategory)
                                                    <option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id === $product->subsubcategory_id ?
                                                        'selected' : '' }}>{{ $subsubcategory->subsubcategory_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('subsubcategory_id')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>Product Tags (English)</h6>
                                        <div class="form-group">
                                            <input name="product_tags_en" value="{{ $product->product_tags_en ? $product->product_tags_en : '' }}" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_tags_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>পণ্যের ট্যাগ (Bangla)</h6>
                                        <div class="form-group">
                                            <input name="product_tags_bn" value="{{ $product->product_tags_bn ? $product->product_tags_bn : '' }}" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_tags_bn')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>Product Size (English)</h6>
                                        <div class="form-group">
                                            <input name="product_size_en" value="{{ $product->product_size_en ? $product->product_size_en : '' }}" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_size_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>পণ্যের আকার (Bangla)</h6>
                                        <div class="form-group">
                                            <input name="product_size_bn" value="{{ $product->product_size_bn ? $product->product_size_bn : '' }}" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_size_bn')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>Product Color (English)</h6>
                                        <div class="form-group">
                                            <input name="product_color_en" value="{{ $product->product_color_en ? $product->product_color_en : '' }}" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_color_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>পণ্যের রঙ (Bangla)</h6>
                                        <div class="form-group">
                                            <input name="product_color_bn" value="{{ $product->product_color_bn ? $product->product_color_bn : '' }}" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_color_bn')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Short Discription (English)</h6>
                                            <div class="form-floating">
                                                <textarea id="editor1" name="short_descp_en" class="form-control">
                                                    {{ $product->short_descp_en ? $product->short_descp_en : '' }}
                                                </textarea>
                                                @error('short_descp_en')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>সংক্ষিপ্ত বর্ণনা (Bangla)</h6>
                                            <div class="form-floating">
                                                <textarea id="editor2" name="short_descp_bn" class="form-control">
                                                    {{ $product->short_descp_bn ? $product->short_descp_bn : '' }}
                                                </textarea>
                                                @error('short_descp_bn')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Long Discription (English)</h6>
                                            <div class="form-floating">
                                                <textarea id="editor3" name="long_descp_en" class="form-control">
                                                    {{ $product->long_descp_en ? $product->long_descp_en : '' }}
                                                </textarea>
                                                @error('long_descp_en')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>দীর্ঘ বর্ণনা (Bangla)</h6>
                                            <div class="form-floating">
                                                <textarea id="editor4" name="long_descp_bn" class="form-control">
                                                    {{ $product->long_descp_bn ? $product->long_descp_bn : '' }}
                                                </textarea>
                                                @error('long_descp_bn')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6 class="form-label">Product Image</h6>
                                            <input onChange="mainThumbnail(this)" id="product_thumbnail" name="product_thumbnail" class="form-control" type="file">
                                            @error('product_thumbnail')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                            <div id="main-thumbnail-card" class="card hidden">
                                                <div class="card-body">
                                                    <img id="main-thumbnail-show" alt="Product Image">
                                                </div>
                                            </div>
                                            <div id="main-thumbnail-card-hide" class="card">
                                                <div class="card-body">
                                                    <img width="200" height="200" src="{{ asset($product->product_thumbnail) }}" alt="Product Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="old_image" value="{{ $product->product_thumbnail }}">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6 class="form-label">Options</h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-inline-block me-2 mb-1">
                                                    <div class="form-check">
                                                        <div class="custom-control custom-checkbox">
                                                            <input {{ $product->hot_deals == 1 ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input form-check-primary" name="hot_deals" id="customColorCheck1">
                                                            <label class="form-check-label" for="customColorCheck1">Hot Deals</label>
                                                        </div>
                                                        @error('hot_deals')
                                                            <span class="text-danger">{{ $message }}</span>    
                                                        @enderror
                                                    </div>
                                                </li>
                                                <li class="d-inline-block me-2 mb-1">
                                                    <div class="form-check">
                                                        <div class="custom-control custom-checkbox">
                                                            <input {{ $product->featured == 1 ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input form-check-secondary" name="featured" id="customColorCheck2">
                                                            <label class="form-check-label" for="customColorCheck2">Featured</label>
                                                        </div>
                                                        @error('featured')
                                                            <span class="text-danger">{{ $message }}</span>    
                                                        @enderror
                                                    </div>
                                                </li>
                                                <li class="d-inline-block me-2 mb-1">
                                                    <div class="form-check">
                                                        <div class="custom-control custom-checkbox">
                                                            <input {{ $product->special_offer == 1 ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input form-check-success" name="special_offer" id="customColorCheck3">
                                                            <label class="form-check-label" for="customColorCheck3">Special Offer</label>
                                                        </div>
                                                        @error('special_offer')
                                                            <span class="text-danger">{{ $message }}</span>    
                                                        @enderror
                                                    </div>
                                                </li>
                                                <li class="d-inline-block me-2 mb-1">
                                                    <div class="form-check">
                                                        <div class="custom-control custom-checkbox">
                                                            <input {{ $product->special_deals == 1 ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input form-check-danger" name="special_deals" id="customColorCheck4">
                                                            <label class="form-check-label" for="customColorCheck4">Special Deals</label>
                                                        </div>
                                                        @error('special_deals')
                                                            <span class="text-danger">{{ $message }}</span>    
                                                        @enderror
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary rounded-pill" type="submit" value="Update Product">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Multiple Image</h4>
                        </div>  
                        @if (!empty($multiimages))      
                        <div class="card-body">
                            <form action="{{ route('multi.image.update') }}" method="POST" enctype= "multipart/form-data">
                                @csrf
                                <div id="multi-image-default" class="row">
                                    @foreach ($multiimages as $multiimage)
                                        <div class="col-sm-6">
                                            <div class="card bg-dark text-white">
                                                <img width="200" height="200" class="card-img" src="{{ asset($multiimage->photo_name) }}" alt="Multiple Product Image">
                                                <div class="card-img-overlay">
                                                    <div class="card-title">
                                                        <a href="{{ route('multi.image.delete', $multiimage->id) }}" class="btn btn-sm btn-danger" id="delete_item"><i class="bi bi-trash" title="Delete">Delete</i></a>
                                                    </div>
                                                    <h6 class="card-title">Change Image</h6>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <input id="multi-image" name="multi_image[{{ $multiimage->id }}]" multiple class="form-control" type="file">
                                                                @error('multi_image')
                                                                    <span class="text-danger">{{ $message }}</span>    
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary rounded-pill" type="submit" value="Update Images">
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                                No Image Found!
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

    function mainThumbnail(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader()
            reader.onload = function(e) {
                document.getElementById('main-thumbnail-card-hide').classList.add('hidden')
                document.getElementById('main-thumbnail-card').classList.remove('hidden')
                $('#main-thumbnail-show').attr('src', e.target.result).width(200).height(200)
            }
            reader.readAsDataURL(input.files[0])
        }
    }

    ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        });
    ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        });
    ClassicEditor
        .create( document.querySelector( '#editor3' ) )
        .catch( error => {
            console.error( error );
        });
    ClassicEditor
        .create( document.querySelector( '#editor4' ) )
        .catch( error => {
            console.error( error );
        });
</script>

@endsection
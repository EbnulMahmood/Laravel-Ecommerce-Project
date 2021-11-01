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
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                            <h4 class="card-title">Add Product</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('product.store') }}" method="POST" enctype= "multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Name (English)</h6>
                                            <input name="product_name_en" type="text" class="form-control" required id="basicInput4" placeholder="Enter Product English Name">
                                            @error('product_name_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>নাম (Bangla)</h6>
                                            <input name="product_name_bn" type="text" class="form-control" required id="basicInput5" placeholder="Enter Product Bangla Name">
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
                                            <input name="product_code" type="text" class="form-control" required id="basicInput8" placeholder="Enter Product Code">
                                            @error('product_code')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Quantity</h6>
                                            <input name="product_qty" type="text" class="form-control" required id="basicInput9" placeholder="Enter Product Quantity">
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
                                            <input name="selling_price" type="text" class="form-control" required id="basicInput4" placeholder="Enter Product Selling Price">
                                            @error('selling_price')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6>Discount Price</h6>
                                            <input name="discount_price" type="text" class="form-control" id="basicInput5" placeholder="Enter Product Discount Price">
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
                                                <option value="" selected="" disabled="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
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
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
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
                                            <select id="subcategory_id" class="form-select" required name="subcategory_id">
                                                <option value="" selected="" disabled="">Select (Parent) Subcategory</option>
                                            </select>
                                            @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                        <h6>Child Category</h6>
                                            <select id="subsubcategory_id" class="form-select" required name="subsubcategory_id">
                                                <option value="" selected="" disabled="">Select (Child) Subcategory</option>
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
                                            <input name="product_tags_en" value="Man,Woman,Kids" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_tags_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>পণ্যের ট্যাগ (Bangla)</h6>
                                        <div class="form-group">
                                            <input name="product_tags_bn" value="পুরুষ,মহিলা,বাচ্চা" class="choices form-select multiple-remove" multiple="multiple">
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
                                            <input name="product_size_en" value="Large,Medium,Small" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_size_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>পণ্যের আকার (Bangla)</h6>
                                        <div class="form-group">
                                            <input name="product_size_bn" value="বড়,মাঝারি,ছোট" class="choices form-select multiple-remove" multiple="multiple">
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
                                            <input name="product_color_en" value="Green,Blue,Red" class="choices form-select multiple-remove" multiple="multiple">
                                            @error('product_color_en')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 col-sm-12">
                                        <h6>পণ্যের রঙ (Bangla)</h6>
                                        <div class="form-group">
                                            <input name="product_color_bn" value="সবুজ,নীল,লাল" class="choices form-select multiple-remove" multiple="multiple">
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
                                                <textarea id="editor1" name="short_descp_en" class="form-control"></textarea>
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
                                                <textarea id="editor2" name="short_descp_bn" class="form-control"></textarea>
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
                                                <textarea id="editor3" name="long_descp_en" class="form-control"></textarea>
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
                                                <textarea id="editor4" name="long_descp_bn" class="form-control"></textarea>
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
                                                    <img id="main-thumbnail-show">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <h6 class="form-label">Options</h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-inline-block me-2 mb-1">
                                                    <div class="form-check">
                                                        <div class="custom-control custom-checkbox">
                                                            <input value="1" type="checkbox" class="form-check-input form-check-primary" name="hot_deals" id="customColorCheck1">
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
                                                            <input value="1" type="checkbox" class="form-check-input form-check-secondary" name="featured" id="customColorCheck2">
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
                                                            <input value="1" type="checkbox" class="form-check-input form-check-success" name="special_offer" id="customColorCheck3">
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
                                                            <input value="1" type="checkbox" class="form-check-input form-check-danger" name="special_deals" id="customColorCheck4">
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
                                    <input class="btn btn-primary rounded-pill" type="submit" value="Add">
                                </div>
                            </form>
                        </div>
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
                document.getElementById('main-thumbnail-card').classList.remove('hidden')
                $('#main-thumbnail-show').attr('src', e.target.result).width(200).height(200)
            }
            reader.readAsDataURL(input.files[0])
        }
    }

    $(document).ready(function() {
        $('#multi-image').on('change', function() {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                const data = $(this)[0].files
                $.each(data, function(index, file) {
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                        const fileReader = new FileReader()
                        fileReader.onload = (function(file) {
                            return function(e) {
                                const img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80).height(80)
                                $('#multi-image-preview').append(img)
                            }
                        })(file)
                        fileReader.readAsDataURL(file)
                    }
                })
            } else {
                alert("Your bowser dosen't support file API!")
            }
        })
    })

    const addDropdownData = function(data, status) {
        if (status === 1) {
            $('#subsubcategory_id').html('');
            $('#subcategory_id').empty();
            if (!Array.isArray(data) || !data.length) {
                $('#subcategory_id').append(
                    `<option value="" selected="" disabled="">No (Parent) Subcategory Found</option>`
                );
            } else {
                $.each(data, function(key, value){
                    $('#subcategory_id').append(
                        `<option value="${value.id}">${value.subcategory_name_en}</option>`
                    );
                });
            }
        }
        else if (status === 0) {
            $('#subsubcategory_id').empty();
            if (!Array.isArray(data) || !data.length) {
                $('#subsubcategory_id').append(
                    `<option value="" selected="" disabled="">No (Child) Subcategory Found</option>`
                );
            } else {
                $.each(data, function(key, value){
                    $('#subsubcategory_id').append(
                        `<option value="${value.id}">${value.subsubcategory_name_en}</option>`
                    );
                });
            }
        }
    }

    const getJSON = async function(url, status) {
        await fetch(url)
        .then(
            function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok!');
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    addDropdownData(data, status)
                });
            }
        )
        .catch(function(err) {
            alert(err.message)
        })
    }

    
    $(document).ready(function() {
        const category_id = document.getElementById('category_id')
        const subcategory_id = document.getElementById('subcategory_id')
        $(category_id).on('change', function() {
            const id = $(this).val();
            if (id) {
                getJSON("{{ url('/category/subcategory/ajax') }}/" + id, 1)
            }
            else {
                alert('warning')
            }
        })
        $(subcategory_id).on('change', function() {
            const id = $(this).val();
            if (id) {
                getJSON("{{ url('/category/sub-subcategory/ajax') }}/" + id, 0)
            }
            else {
                alert('warning')
            }
        })
    })

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
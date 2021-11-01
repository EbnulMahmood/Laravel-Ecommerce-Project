@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Category</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('all.category') }}">All Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Category</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('category.update', $category->id) }}" method="POST" enctype= "multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="basicInput1">Name (English)</label>
                                        <input name="category_name_en" type="text" class="form-control" value="{{ $category->category_name_en }}" id="basicInput1" placeholder="Enter English Name">
                                        @error('category_name_en')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput2">নাম (Bangla)</label>
                                        <input name="category_name_bn" type="text" class="form-control" value="{{ $category->category_name_bn }}" id="basicInput2" placeholder="Enter Bangla Name">
                                        @error('category_name_bn')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category-image" class="form-label">Image</label>
                                        <input id="category-image" name="category_icon" class="form-control" type="file">
                                        @error('category_icon')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <input type="hidden" name="old_image" value="{{ $category->category_icon }}">
                                    <div class="form-group">
                                        <input class="btn btn-primary rounded-pill" type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-6 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">{{ $category->category_name_en }}</h4>
                                <img id="show-image" class="img-fluid w-50" src="{{ asset($category->category_icon) }}" alt="Category Image">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('#category-image').change(function(e) {
            const reader = new FileReader()
            reader.onload = function(e) {
                $('#show-image').attr('src', e.target.result)
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    })
</script>

@endsection
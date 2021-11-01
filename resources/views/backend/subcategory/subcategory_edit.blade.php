@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Subcategory</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('all.subcategory') }}">All Subcategory</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Subcategory</li>
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
                            <h4 class="card-title">Edit Subcategory</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <select class="choices form-select" required name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ?
                                                'selected' : '' }}>{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput1">Name (English)</label>
                                        <input name="subcategory_name_en" type="text" class="form-control" value="{{ $subcategory->subcategory_name_en }}" id="basicInput1" placeholder="Enter English Name">
                                        @error('subcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput2">নাম (Bangla)</label>
                                        <input name="subcategory_name_bn" type="text" class="form-control" value="{{ $subcategory->subcategory_name_bn }}" id="basicInput2" placeholder="Enter Bangla Name">
                                        @error('subcategory_name_bn')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
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
                        <div class="card-header">
                            <h4 class="card-title">{{ $subcategory->category->category_name_en }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <img id="show-image" class="img-fluid w-50" src="{{ asset($subcategory->category->category_icon) }}" alt="Category Image">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection
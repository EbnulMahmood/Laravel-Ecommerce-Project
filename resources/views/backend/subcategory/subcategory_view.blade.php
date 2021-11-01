@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Parent Subategories</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Subcategory</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>নাম</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->category->category_name_en }}</td>
                                        <td>{{ $subcategory->subcategory_name_en }}</td>
                                        <td>{{ $subcategory->subcategory_name_bn }}</td>
                                        <td width="30%">
                                            <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil" title="Edit">Edit</i></a>
                                            <a href="{{ route('subcategory.delete', $subcategory->id) }}" class="btn btn-sm btn-danger" id="delete_item"><i class="bi bi-trash" title="Delete">Delete</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Subcategory</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('subcategory.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="basicInput">Category</label>
                                        <select class="choices form-select" required name="category_id">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput1">Name (English)</label>
                                        <input name="subcategory_name_en" type="text" class="form-control" required id="basicInput1" placeholder="Enter English Name">
                                        @error('subcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput2">নাম (Bangla)</label>
                                        <input name="subcategory_name_bn" type="text" class="form-control" required id="basicInput2" placeholder="Enter Bangla Name">
                                        @error('subcategory_name_bn')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary rounded-pill" type="submit" value="Add">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection
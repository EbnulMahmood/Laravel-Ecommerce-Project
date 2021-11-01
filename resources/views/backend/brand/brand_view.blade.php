@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Brands</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Brand</li>
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
                                    <th>Name</th>
                                    <th>নাম</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->brand_name_en }}</td>
                                        <td>{{ $brand->brand_name_bn }}</td>
                                        <td>
                                            <div class="avatar bg-warning me-3">
                                                <img src="{{ asset($brand->brand_image) }}" alt="Brand" srcset="">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil" title="Edit">Edit</i></a>
                                            <a href="{{ route('brand.delete', $brand->id) }}" class="btn btn-sm btn-danger" id="delete_item"><i class="bi bi-trash" title="Delete">Delete</i></a>
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
                            <h4 class="card-title">Add Brand</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="POST" enctype= "multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="basicInput1">Name (English)</label>
                                        <input name="brand_name_en" type="text" class="form-control" required id="basicInput1" placeholder="Enter English Name">
                                        @error('brand_name_en')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput2">নাম (Bangla)</label>
                                        <input name="brand_name_bn" type="text" class="form-control" required id="basicInput2" placeholder="Enter Bangla Name">
                                        @error('brand_name_bn')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="brand-image" class="form-label">Image</label>
                                        <input id="brand-image" name="brand_image" class="form-control" required type="file">
                                        @error('brand_image')
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
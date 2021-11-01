@extends('admin.admin_master')
@section('admin')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Child categories</h3>
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
                                    <th>Subcategory</th>
                                    <th>Name</th>
                                    <th>নাম</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subsubcategories as $subsubcategory)
                                    <tr>
                                        <td>{{ $subsubcategory->subcategory->subcategory_name_en }}</td>
                                        <td>{{ $subsubcategory->subsubcategory_name_en }}</td>
                                        <td>{{ $subsubcategory->subsubcategory_name_bn }}</td>
                                        <td width="30%">
                                            <a href="{{ route('subsubcategory.edit', $subsubcategory->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil" title="Edit">Edit</i></a>
                                            <a href="{{ route('subsubcategory.delete', $subsubcategory->id) }}" class="btn btn-sm btn-danger" id="delete_item"><i class="bi bi-trash" title="Delete">Delete</i></a>
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
                            <form action="{{ route('subsubcategory.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="basicInput1">Parent Category</label>
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
                                        <label for="basicInput2">Child Category</label>
                                        <select class="form-select" id="subcategory_id" required name="subcategory_id">
                                            <option value="" selected="" disabled="">Select Subcategory</option>
                                        </select>
                                        @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput3">Name (English)</label>
                                        <input name="subsubcategory_name_en" type="text" class="form-control" required id="basicInput3" placeholder="Enter English Name">
                                        @error('subsubcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput4">নাম (Bangla)</label>
                                        <input name="subsubcategory_name_bn" type="text" class="form-control" required id="basicInput4" placeholder="Enter Bangla Name">
                                        @error('subsubcategory_name_bn')
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

<script type="text/javascript">

    const addSubcategory = function(data) {
        $('#subcategory_id').empty();
        if (!Array.isArray(data) || !data.length) {
            $('#subcategory_id').append(
                `<option value="" selected="" disabled="">No Subcategory Found</option>`
            );
        } else {
            $.each(data, function(key, value){
                $('#subcategory_id').append(
                    `<option value="${value.id}">${value.subcategory_name_en}</option>`
                );
            });
        }
    }

    const getJSON = async function(url) {
        await fetch(url)
        .then(
            function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok!');
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    addSubcategory(data)
                });
            }
        )
        .catch(function(err) {
            alert(err.message)
        })
    }

    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            const category_id = $(this).val();
            if (category_id) {
                getJSON("{{ url('/category/subcategory/ajax') }}/" + category_id)
            }
            else {
                alert('warning')
            }
        })
    })
</script>

@endsection
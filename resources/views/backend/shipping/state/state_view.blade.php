@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>State <span class="badge rounded-pill bg-info">{{ count($states) }}</span></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All State</li>
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
                                    <th>Division Name</th>
                                    <th>District Name</th>
                                    <th>State Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($states as $state)
                                    <tr>
                                        <td>{{ $state->division->division_name }}</td>
                                        <td>{{ $state->district->district_name }}</td>
                                        <td>{{ $state->state_name }}</td>
                                        <td width="30%">
                                            <a href="{{ route('state.edit', $state->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil" title="Edit">Edit</i></a>
                                            <a href="{{ route('state.delete', $state->id) }}" class="btn btn-sm btn-danger" id="delete_item"><i class="bi bi-trash" title="Delete">Delete</i></a>
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
                            <h4 class="card-title">Add State</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('state.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="basicInput1">Division Name</label>
                                        <select class="choices form-select" required name="division_id">
                                            <option value="" selected="" disabled="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput1">District Name</label>
                                        <select class="form-select" id="district_id" required name="district_id">
                                            <option value="" selected="" disabled="">Select District</option>
                                        </select>
                                        @error('district_id')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput1">State Name</label>
                                        <input name="state_name" type="text" class="form-control" required id="basicInput1" placeholder="Enter Name">
                                        @error('state_name')
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
        $('#district_id').empty();
        if (!Array.isArray(data) || !data.length) {
            $('#district_id').append(
                `<option value="" selected="" disabled="">No District Found</option>`
            );
        } else {
            $.each(data, function(key, value){
                $('#district_id').append(
                    `<option value="${value.id}">${value.district_name}</option>`
                );
            });
        }
    }

    const getDistrictJSON = async function(url) {
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
        $('select[name="division_id"]').on('change', function() {
            const division_id = $(this).val();
            if (division_id) {
                getDistrictJSON("{{ url('/shipping/district/ajax') }}/" + division_id)
            }
            else {
                alert('warning')
            }
        })
    })
</script>

@endsection
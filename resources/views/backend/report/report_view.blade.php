@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Reports</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Reports</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search by date</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <label for="basicInput1">Select Date</label>
                                <form action="{{ route('search.by.date') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <input name="date" type="date" class="form-control" required>
                                                @error('date')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                                <input class="btn btn-primary" type="submit" value="Search">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search by month</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <label for="basicInput2">Select Month</label>
                                <form action="{{ route('search.by.month') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <input id="month" type="month" name="month" class="form-control" required>
                                                @error('month')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                                <input class="btn btn-primary" type="submit" value="Search">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search by year</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <label for="basicInput3">Enter Year</label>
                                <form action="{{ route('search.by.year') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <input id="year" type="text" name="year" class="form-control" required>
                                                @error('year')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                                <input class="btn btn-primary" type="submit" value="Search">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection
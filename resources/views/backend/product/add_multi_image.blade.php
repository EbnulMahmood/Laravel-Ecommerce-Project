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
                        <li class="breadcrumb-item active" aria-current="page">Add Multiple Image</li>
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
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>{{ $product->product_name_en }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <img width="350" height="400" src="{{ asset($product->product_thumbnail) }}" alt="Product Image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">        
                                <div class="card-body">
                                    <form action="{{ route('multi.image.store', $product->id) }}" method="POST" enctype= "multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <h6 class="form-label">Multiple Images</h6>
                                            <input id="multi-image" name="multi_image[]" multiple class="form-control" type="file">
                                            @error('multi_image')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                            <div id="multi-image-section" class="card hidden">
                                                <div class="card-body">
                                                    <div id="multi-image-preview" class="row">
                                                    </div>
                                                </div>
                                            </div>
                                            @if (!empty($multiimages))
                                                <div id="multi-image-default" class="row">
                                                    @foreach ($multiimages as $multiimage)
                                                        <div class="col-sm-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <img width="200" height="200" src="{{ asset($multiimage->photo_name) }}" alt="Multiple Image" srcset="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-primary rounded-pill" type="submit" value="Add">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#multi-image').on('change', function() {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                const data = $(this)[0].files
                document.getElementById('multi-image-default').classList.add('hidden')
                document.getElementById('multi-image-section').classList.remove('hidden')
                $.each(data, function(index, file) {
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                        const fileReader = new FileReader()
                        fileReader.onload = (function(file) {
                            return function(e) {
                                const img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(200).height(200)
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

</script>

@endsection
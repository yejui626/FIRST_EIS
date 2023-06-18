@extends('layouts.app', [
'class' => '',
'elementActive' => 'product'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4>Add Product</h4>
                </div>

                <div class="card-body ">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        {!! @csrf_field() !!}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Name
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name">
                                @error('product_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Code
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_code" placeholder="Enter Product Code">
                                @error('product_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Selling Price
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_sellingprice" placeholder="Enter Product Selling Price (RM)">
                                @error('product_sellingprice')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Price
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_supplierprice" placeholder="Enter Product Supplier Price (RM)">
                                @error('product_supplierprice')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 1
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img1">
                                @error('product_img1')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 2</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img2">

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 3</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img3">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Details
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <textarea cols="100" rows="10" placeholder="Enter Product Details" name="product_details"></textarea>
                            </div>
                            @error('product_details')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>



                        <br>
                        <button class="btn btn-primary btn-lg btn-block">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
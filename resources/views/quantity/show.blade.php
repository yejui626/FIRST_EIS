@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'quantity'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4>Product Details</h4>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{$product->product_name}}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Category</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_category" placeholder="Enter Category Name" value="{{$product->productCategory->category_name}}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Code</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_code" placeholder="Enter Product Code" value="{{$product->product_code}}" readonly>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Selling Price</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_sellingprice" placeholder="Enter Product Selling Price (RM)" value="{{$product->product_sellingprice}}" readonly >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Price</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_supplierprice" placeholder="Enter Product Supplier Price (RM)" value="{{$product->product_supplierprice}}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 1</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_img1" placeholder="IMG" value="{{$product->product_img1}}" readonly>
                                <br>
                                <img src="{{$product->product_img1}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 2</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_img2" placeholder="IMG" value="{{$product->product_img2}}"readonly>
                                <br>
                                <img src="{{$product->product_img2}}" class="img img-responsive"></img>
                            </div>
                            
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 3</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_img3" placeholder="IMG" value="{{$product->product_img3}}"readonly>
                                <br>
                                <img src="{{$product->product_img3}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Details</label>
                            <div class="col-md-10">
                                <textarea cols="100" rows="10" placeholder="Enter Product Details" name="product_details"readonly>{{$product->product_details}}</textarea>
                            </div>
                        </div> 
                            <br>
                            <a role="button" href="{{ route('quantity.index') }}" class="btn btn-primary btn-lg btn-block">Return to Product List</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                        <h4>Edit Quantity</h4>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('quantity.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    {!! @csrf_field() !!}
                        @method('PUT')
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Name
                            
                            </label>
                            <div class="col-md-10">
                                <input readonly type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{$product->product_name}}">
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Code
                            
                            </label>
                            <div class="col-md-10">
                                <input readonly type="text" class="form-control" name="product_code" placeholder="Enter Product Code" value="{{$product->product_code}}" >
                                
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Selling Price
                            
                            </label>
                            <div class="col-md-10">
                                <input readonly type="number" class="form-control" name="product_sellingprice" placeholder="Enter Product Selling Price (RM)" value="{{$product->product_sellingprice}}" >
                                
                            </div>
                        </div>
                    
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Details
                            
                            </label>
                            <div class="col-md-10">
                               <textarea cols="100" rows="10" placeholder="Enter Product Details" name="product_details" readonly>{{$product->product_details}}</textarea>
</div>
                               
                            </div>
                            
                            <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Quantity
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_quantity" placeholder="Enter Product Quantity" value="{{$product->product_quantity}}" >
                                @error('product_quantity')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        

                                    
                                <br>
                                <button class="btn btn-primary btn-lg btn-block">Update Quantity</button>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
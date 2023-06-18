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
                        <h4>Add Inventory List</h4>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('quantity.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Name
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                            <select name="quantity_productid" placeholder="Select a Product">
                            <option value="none" selected disabled hidden>Select a Product</option>
        @foreach($product as $p)
            <option value="{{ $p->id }}">{{ $p->product_name }}</option>
        @endforeach
    </select>
    @error('quantity_productid')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
</div>

                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Quantity
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="quantity_product" placeholder="Enter Product Quantity"  >
                                @error('quantity_product')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        
                        

                                    
                                <br>
                                <button class="btn btn-primary btn-lg btn-block">Add Inventory List</button>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
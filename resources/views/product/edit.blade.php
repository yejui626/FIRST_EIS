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
                        <h4>Edit Product</h4>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    {!! @csrf_field() !!}
                        @method('PUT')
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Name
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{$product->product_name}}">
                                @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        

                        <div class="mb-3 row">
    <label class="col-md-2 col-form-label">Product Category<span class="text-danger">*</span></label>
    <div class="col-md-10">
        <select name="product_category" class="form-control" onchange="showCategoryFields(this)">
            @foreach($categories as $category)
        <option value="{{ $category->category_id }}" @if($category->category_id == $product->product_category) selected @endif>{{ $category->category_name }}</option>
            @endforeach
        </select>
        @error('product_category')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
                        
                        <div id="specs-fields-container">
    @foreach($categories as $category)
        @if($category->category_id == $product->product_category)
            @foreach(['specs1', 'specs2', 'specs3'] as $field)
                @if(!empty($category->$field))
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">{{$category->$field}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="{{$field}}" placeholder="Enter {{$category->$field}}" value="{{$product->$field ?? ''}}" >
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach
</div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Code
                            
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_code" placeholder="Enter Product Code" value="{{$product->product_code}}" >
                                
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Selling Price
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_sellingprice" placeholder="Enter Product Selling Price (RM)" value="{{$product->product_sellingprice}}" >
                                @error('product_sellingprice')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Price
                            
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_supplierprice" placeholder="Enter Product Supplier Price (RM)" value="{{$product->product_supplierprice}}">
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 1
                            
                            </label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img1" placeholder="Product Image 1" value="{{$product->product_img1}}">
    
                                <br>
                                <img src="{{$product->product_img1}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 2</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img2" placeholder="Product Image 2" value="{{$product->product_img2}}">
                                <br>
                                <img src="{{$product->product_img2}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 3</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img3" placeholder="Product Image 3" value="{{$product->product_img3}}">
                                <br>
                                <img src="{{$product->product_img3}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Details
                            
                            </label>
                            <div class="col-md-10">
                            <textarea cols="100" rows="10" placeholder="Enter Product Details" name="product_details">{{$product->product_details}}</textarea>
                            </div>
                            
                        </div>  
                            <br>
                            <button class="btn btn-primary btn-lg btn-block">Edit Product</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
function showCategoryFields(select) {
    var category = select.value;
    var specsFields = {!! json_encode($categories->mapWithKeys(function ($category) { return [$category->category_id => [$category->specs1, $category->specs2, $category->specs3]]; })->toArray()) !!};
    var fieldsContainer = document.getElementById('specs-fields-container');

    // Reset all fields
    fieldsContainer.innerHTML = '';

    // Generate fields based on the selected category
    if (category in specsFields) {
        var specsFieldNames = specsFields[category];
        specsFieldNames.forEach(function (fieldName) {
            if (fieldName) {
                var label = document.createElement('label');
                label.className = 'col-md-2 col-form-label';
                label.innerText = fieldName;

                var div = document.createElement('div');
                div.className = 'col-md-10';

                var input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control';
                input.name = 'specs[]';
                input.placeholder = 'Enter ' + fieldName;

                div.appendChild(input);

                var row = document.createElement('div');
                row.className = 'mb-3 row';
                row.appendChild(label);
                row.appendChild(div);

                fieldsContainer.appendChild(row);
            }
        });
    }
}

</script>
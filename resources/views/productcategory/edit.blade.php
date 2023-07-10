@extends('layouts.app', [
'class' => '',
'elementActive' => 'productcategory'
])

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors-all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>
@endif


<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4>Edit Product</h4>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('productcategory.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('productcategory.update', $productcategory->category_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Category Name:
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                            <input type="text" name="category_name" value="{{ $productcategory->category_name }}" class="form-control" placeholder="Category Name">
                                @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>  
                         <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Specification 1:
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" name="specs1" class="form-control" value="{{ $productcategory->specs1 }}" placeholder="Specification 1">
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Specification 2:
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" name="specs2" class="form-control" value="{{ $productcategory->specs2 }}" placeholder="Specification 2">
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Specification 3:
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" name="specs3" class="form-control" value="{{ $productcategory->specs3 }}" placeholder="Specification 3" >
                                
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
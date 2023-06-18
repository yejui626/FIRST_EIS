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
                    <h4>Add Category</h4>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('productcategory.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body ">
                    <form action="{{ route('productcategory.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Category Name:
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                                @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-lg btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
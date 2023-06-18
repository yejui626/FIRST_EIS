@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'supplier'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4>Edit Supplier Details</h4>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Name
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value = "{{ $supplier->supplier_name }}" name="supplier_name" >
                                @error('supplier_name')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Phone Number
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_phone" placeholder="Enter Supplier Phone Number" value = "{{ $supplier->supplier_phone }}" >
                                @error('supplier_phone')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Address
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                               <textarea cols="100" rows="10" placeholder="Enter Supplier Address" name="supplier_address">{{ $supplier->supplier_address }}</textarea>
</div>
                               @error('supplier_address')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Description
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                               <textarea cols="100" rows="10"  name="supplier_details">{{ $supplier->supplier_details }}</textarea>
</div>
                               @error('supplier_details')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                                    
                        

                                    
                                <br>
                                <button class="btn btn-primary btn-lg btn-block">Edit Supplier Details</button>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
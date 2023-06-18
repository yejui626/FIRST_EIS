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
                        <h4>Add Supplier</h4>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('supplier.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Name
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_name" placeholder="Enter Supplier Name" >
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
                                <input type="text" class="form-control" name="supplier_phone" placeholder="Enter Supplier Phone Number" >
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
                               <textarea cols="100" rows="10" placeholder="Enter Supplier Address" name="supplier_address"></textarea>
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
                               <textarea cols="100" rows="10" placeholder="Enter Supplier Details" name="supplier_details"></textarea>
</div>
                               @error('supplier_details')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>            
                        

                                    
                                <br>
                                <button class="btn btn-primary btn-lg btn-block">Add Supplier</button>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
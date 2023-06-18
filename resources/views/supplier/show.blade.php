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
                        <h4>Supplier Details</h4>
                    </div>
                    <div class="card-body ">

                    <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier ID</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_name" placeholder="Enter Service Name" value = "{{ $supplier->id }}" readonly>
                            </div>
                        </div>
                    
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_name" placeholder="Enter Service Name" value = "{{ $supplier->supplier_name }}" readonly>
                            </div>
                        </div>
                                    
                        <div class="mb-3 row">
                            <label  class="col-md-2 col-form-label">Supplier Phone Number</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="supplier_phone"  readonly>  {{ $supplier->supplier_phone }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label  class="col-md-2 col-form-label">Supplier Address</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="supplier_address"  readonly>  {{ $supplier->supplier_address }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label  class="col-md-2 col-form-label">Supplier Description</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="supplier_details"  readonly>  {{ $supplier->supplier_details }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Created at</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="created_at"  value = "{{ $supplier->created_at }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Updated at</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="updated_at"  value = "{{ $supplier->updated_at }}" readonly>
                            </div>
                        </div>

                                    
                                <br>
                                <a role="button" href="{{ route('supplier.index') }}" class="btn btn-primary btn-lg btn-block">Return to Supplier List</a>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
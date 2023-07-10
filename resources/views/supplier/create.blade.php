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
                                <input type="text" class="form-control" name="supplier_address" placeholder="Enter Supplier Address (Streets/No.)" >
</div>
                               @error('supplier_address')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="mb-3 row">
    <label class="col-md-2 col-form-label">Supplier State
        <span class="text-danger">*</span>
    </label>
    <div class="col-md-10">
        <select name="supplier_address_state" class="form-control">
            <option value="">Select State</option>
            <option value="Johor">Johor</option>
            <option value="Kedah">Kedah</option>
            <option value="Kelantan">Kelantan</option>
            <option value="Melaka">Melaka</option>
            <option value="Negeri Sembilan">Negeri Sembilan</option>
            <option value="Pahang">Pahang</option>
            <option value="Perak">Perak</option>
            <option value="Perlis">Perlis</option>
            <option value="Pulau Pinang">Pulau Pinang</option>
            <option value="Sabah">Sabah</option>
            <option value="Sarawak">Sarawak</option>
            <option value="Selangor">Selangor</option>
            <option value="Terengganu">Terengganu</option>
            <option value="Kuala Lumpur">Kuala Lumpur</option>
            <option value="Labuan">Labuan</option>
            <option value="Putrajaya">Putrajaya</option>
        </select>
    </div>
</div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier City
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_address_city" placeholder="Enter Supplier City" >
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Postcode
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_address_postcode" placeholder="Enter Supplier Postcode" >
                               
                            </div>
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
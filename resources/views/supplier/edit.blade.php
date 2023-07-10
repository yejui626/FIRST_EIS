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
                                <input type="text" class="form-control" name="supplier_address" placeholder="Enter Supplier Address (Streets/No.)" value = "{{ $supplier->supplier_address }}">
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
            <option value="Johor" @if($supplier->supplier_address_state == 'Johor') selected @endif>Johor</option>
            <option value="Kedah" @if($supplier->supplier_address_state == 'Kedah') selected @endif>Kedah</option>
            <option value="Kelantan" @if($supplier->supplier_address_state == 'Kelantan') selected @endif>Kelantan</option>
            <option value="Melaka" @if($supplier->supplier_address_state == 'Melaka') selected @endif>Melaka</option>
            <option value="Negeri Sembilan" @if($supplier->supplier_address_state == 'Negeri Sembilan') selected @endif>Negeri Sembilan</option>
            <option value="Pahang" @if($supplier->supplier_address_state == 'Pahang') selected @endif>Pahang</option>
            <option value="Perak" @if($supplier->supplier_address_state == 'Perak') selected @endif>Perak</option>
            <option value="Perlis" @if($supplier->supplier_address_state == 'Perlis') selected @endif>Perlis</option>
            <option value="Pulau Pinang" @if($supplier->supplier_address_state == 'Pulau Pinang') selected @endif>Pulau Pinang</option>
            <option value="Sabah" @if($supplier->supplier_address_state == 'Sabah') selected @endif>Sabah</option>
            <option value="Sarawak" @if($supplier->supplier_address_state == 'Sarawak') selected @endif>Sarawak</option>
            <option value="Selangor" @if($supplier->supplier_address_state == 'Selangor') selected @endif>Selangor</option>
            <option value="Terengganu" @if($supplier->supplier_address_state == 'Terengganu') selected @endif>Terengganu</option>
            <option value="Kuala Lumpur" @if($supplier->supplier_address_state == 'Kuala Lumpur') selected @endif>Kuala Lumpur</option>
            <option value="Labuan" @if($supplier->supplier_address_state == 'Labuan') selected @endif>Labuan</option>
            <option value="Putrajaya" @if($supplier->supplier_address_state == 'Putrajaya') selected @endif>Putrajaya</option>
        </select>
    </div>
</div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier City
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_address_city" placeholder="Enter Supplier City" value = "{{ $supplier->supplier_address_city }}">
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Postcode
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="supplier_address_postcode" placeholder="Enter Supplier Postcode" value = "{{ $supplier->supplier_address_postcode }}" >
                               
                            </div>
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
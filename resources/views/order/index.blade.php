@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'order'
])

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="role">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <h4 class="card-title">Orders</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Order ID</th>
                                <th>Customer ID</th>
                                <th>Price</th>
                                
                                <th>Status</th>
                                <th>View Item</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($order as $od)
                                <tr>
                                    <td>{{ $od->id }}</td>
                                    <td>{{ $od->user_id }}</td>
                                    <td>{{ $od->totalprice}}</td>
                                    <td>{{ $od->delivery_status}}</td>
                                    
                                    <td>
                                        <!-- Pop-up Button -->
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#popup-{{$od->id}}">
                                            View
                                        </button>

                                     <!-- Pop-up Content -->
                                        <div class="modal fade" id="popup-{{$od->id}}" tabindex="-1" role="dialog" aria-labelledby="popup-{{$od->id}}-label" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="popup-{{$od->id}}-label">View Items</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Items:</h6>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product ID</th>
                                                                        <th>Product Name</th>
                                                                        <th>Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($od->items as $item)
                                                                    <tr>
                                                                        <td>{{ $item->product_id }}</td>
                                                                        <td>{{ $item->product->product_name }}</td>
                                                                        <td>{{ $item->product_quantity }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                    
                                    
                                    <td>
                                        <!-- Pop-up Button -->
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ppopup-{{$od->id}}">
                                            Update
                                        </button>

                                        <!-- Pop-up Content -->
                                        <div class="modal fade" id="ppopup-{{$od->id}}" tabindex="-1" role="dialog" aria-labelledby="ppopup-{{$od->id}}-label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('orders.update', $od->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ppopup-{{$od->id}}-label">Update Order Status</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="status">Status:</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="Packing">Packing</option>
                                                                    <option value="Unpack">Unpack</option>
                                                                    <option value="Transfer to logistic">Transfer to logistic</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

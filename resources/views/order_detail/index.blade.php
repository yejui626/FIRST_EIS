@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'order-detail'
])

@section('content')

<style>
.customer-info-box {
    float: right;
    border: 1px solid #ccc;
    padding: 10px;
    width: 250px;
}
</style>

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

                    <h4 class="card-title">Order Details</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="order-table"> <!-- Added id attribute -->
                            <thead class="text-primary">
                                <th>Order ID</th>
                                <th>Customer ID</th>
                                <th>Total Price (RM)</th>
                                <th>Status</th>
                                <th>View Item</th>
                            </thead>
                            <tbody>
                                @foreach($orders as $od)
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
                                                        <div class="customer-info-box">
                                                            <h6>Customer Information</h6>
                                                            <hr>
                                                            <p><strong>Customer Name:</strong> {{ $od->user->name }}</p>
                                                            <p><strong>Address:</strong> {{ $od->payment->address }}</p>
                                                            <p><strong>Phone Number:</strong> {{ $od->payment->phone }}</p>
                                                        </div>
                                                        <div class="order-items">
                                                            <div class="table-responsive">
                                                            <h6>Items:</h6>
                                                                <table class="table table-bordered" id="order-{{$od->id}}">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Product ID</th>
                                                                            <th>Product Name</th>
                                                                            <th>Price per Unit (RM)</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($od->items as $item)
                                                                        <tr>
                                                                            <td>{{ $item->product_id }}</td>
                                                                            <td>{{ $item->product->product_name }}</td>
                                                                            <td>{{ $item->product->product_sellingprice }}</td>
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

@push('scripts')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        // Apply DataTables to the main table
        $('#order-table').DataTable({
            responsive: true,
            autoWidth: true,
            scrollX: false,
        });

        // Apply DataTables to each order details table
        @foreach($orders as $od)
            $('#order-{{$od->id}}').DataTable({
                responsive: true,
                autoWidth: true,
                scrollX: false,
            });
        @endforeach
    });
</script>
@endpush

@endsection

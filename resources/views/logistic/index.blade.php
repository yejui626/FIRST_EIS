@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'logistic-detail'
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

                    <h4 class="card-title">Logistic Details</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="order-table"> <!-- Added id attribute -->
                            <thead class="text-primary">
                                <th>Sender Name</th>
                                <th>Recipient Name</th>
                                <th>Courier</th>
                                <th>Tracking Number</th>
                                <th>AWB</th>
                                <th>Shipment Date</th>
                                <th>Status</th>
                                <th>View Order</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($logistics as $log)
                                <tr>
                                    <td>{{ $log->sender_name}}</td>
                                    <td>{{ $log->recipient_name }}</td>
                                    <td>{{ $log->courier }}</td>
                                    <td><a href="{{ $log->tracking_url }}">{{ $log->tracking_number }}</a></td>
                                    <td><a href="{{ $log->awb_id_link }}">Print</a></td>
                                    <td>{{ $log->shipment_date }}</td>
                                    <td>{{ $log->status}}</td>
                                    <td>
                                        <!-- Pop-up Button -->
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#popup-{{$log->order_id}}">
                                            View
                                        </button>

                                     <!-- Pop-up Content -->
                                        <div class="modal fade" id="popup-{{$log->order_id}}" tabindex="-1" role="dialog" aria-labelledby="popup-{{$log->order_id}}-label" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="popup-{{$log->order_id}}-label">View Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Order {{ $log->order_id}}:</h6>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="order-{{$log->order_id}}"> <!-- Added id attribute -->
                                                                <thead>
                                                                    <tr>
                                                                        <th>Order ID</th>
                                                                        <th>Customer ID</th>
                                                                        <th>Price</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $log->order->id }}</td>
                                                                        <td>{{ $log->order->user_id ?? '' }}</td>
                                                                        <td>{{ $log->order->totalprice ?? '' }}</td>
                                                                    </tr>
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
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#ppopup-{{$log->id}}">
                                            <i class="nc-icon nc-delivery-fast"></i> EasyParcel
                                        </button>
                                        <!-- Pop-up Content -->
                                        <div class="modal fade" id="ppopup-{{$log->id}}" tabindex="-1" role="dialog" aria-labelledby="ppopup-{{$log->id}}-label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('logistic.update', $log->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ppopup-{{$log->id}}-label">Make EasyParcel Order</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="status">Weight:</label>
                                                                <input type="number" class="form-control" id="weight" name="weight" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="collect_date">Collect Date:</label>
                                                                <input type="text" class="form-control datepicker" id="collect_date" name="collect_date" placeholder="Only Weekdays!"required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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

@push('scripts')
<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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

        $('#collect_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: 'today',
            daysOfWeekDisabled: '0,6', // Disables Saturdays (0) and Sundays (6)
            autoclose: true
        });

        // Apply DataTables to each order details table
        @foreach($logistics as $log)
            $('#order-{{$log->order_id}}').DataTable({
                responsive: true,
                autoWidth: true,
                scrollX: false,
            });
        @endforeach
    });
</script>
@endpush

@endsection

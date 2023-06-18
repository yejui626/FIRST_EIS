@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'grn'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <a href="{{ route('grn.create') }}" class="btn btn-primary" role="button" style="float: right;">
                        <i class="fa fa-plus"></i> Add
                    </a>
                    <h4 class="card-title">Goods Receipt Note (GRN) List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="grn-table" class="table table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>GRN Number</th>
                                    <th>Purchase Order Number</th>
                                    <th>Supplier</th>
                                    <th>To</th>
                                    <th>Recipient</th>
                                    <th>Received At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grn as $grnItem)
                                <tr>
                                    <td>{{ $grnItem->id }}</td>
                                    <td>{{ $grnItem->grn_number }}</td>
                                    <td>{{ $grnItem->purchase_order_no }}</td>
                                    <td>{{ $grnItem->supplier_id}}</td>
                                    <td>{{ $grnItem->to_grn }}</td>
                                    <td>{{ $grnItem->recipient_grn }}</td>
                                    <td>{{ $grnItem->received_date }}</td>
                                    <td>
                                        <a href="{{ route('grn.show', $grnItem->id) }}" class="btn btn-primary mr-1" target="_blank">
                                            Detail
                                        </a>
                                        <a href="{{ route('grn.edit', $grnItem->id) }}" class="btn btn-default mr-1">
                                            Edit
                                        </a>
                                        <form action="{{ route('grn.destroy', $grnItem->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this GRN?')">Delete</button>
                                        </form>
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
        $('#grn-table').DataTable({
            responsive: true, // Enable responsive mode
            autoWidth: false, // Disable automatic column width calculation
        });
    });
</script>
@endpush
@endsection

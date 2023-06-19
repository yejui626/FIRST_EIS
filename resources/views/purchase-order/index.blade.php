@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchase-order'
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
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    <h4 class="card-title">Purchase Order List</h4>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="po-table1" class="table table-striped">
                            <thead class="text-primary">
                                <th>Purchase Order ID</th>
                                <th>Purchase Order No.</th>
                                <th>Supplier Name</th>
                                <th>Total Items</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($purchaseorder as $po)
                                @if($po->status != 'Closed')
                                <tr>
                                    <td>{{$po->po_id}}</td>
                                    <td>{{$po->po_no}}</td>
                                    <td>{{$po->supplier->supplier_name}}</td>
                                    <td>{{$po->orderitems->count()}}</td>
                                    <td>{{$po->created_at}}</td>
                                    <td>{{$po->status}}</td>
                                    <td class="text-right">
                                        <?php $role = Auth::user()->role; ?>
                                        @if($role == 3)
                                        <button class="btn btn-secondary mr-1" type="button" data-toggle="modal" data-target="#popup-{{ $po->po_id }}">
                                            Update Status
                                        </button> 

                                        <!-- Pop-up Content -->
                                        <div class="modal fade" id="popup-{{$po->po_id}}" tabindex="-1" role="dialog" aria-labelledby="popup-{{$po->po_id}}-label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('po.updateStatus', $po->po_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="status">Status:</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="Ordered">Ordered</option>
                                                                    <option value="Closed">Closed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <a href="{{route('po.show', $po->po_id)}}" class="btn btn-primary mr-1" type="button">Detail</a>
                                        <?php $role = Auth::user()->role; ?>
                                        @if($role == 2)
                                        <a href="{{route('po.edit', $po->po_id)}}" class="btn btn-default mr-1" type="button">Edit</a>
                                        <form action="{{route('po.destroy', $po->po_id)}}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Confirm deleting order?')">
                                            <button class="btn btn-danger">Delete</button>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="po-table2" class="table table-striped">
                                <h4 class="card-title"> Closed Purchase Order</h4>
                                    <thead class="text-primary">
                                        <th>Purchase Order ID</th>
                                        <th>Purchase Order No.</th>
                                        <th>Supplier Name</th>
                                        <th>Total Items</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        @foreach($purchaseorder as $po)
                                        @if($po->status == 'Closed')
                                        <tr>
                                            <td>{{$po->po_id}}</td>
                                            <td>{{$po->po_no}}</td>
                                            <td>{{$po->supplier->supplier_name}}</td>
                                            <td>{{$po->orderitems->count()}}</td>
                                            <td>{{$po->created_at}}</td>
                                            <td>{{$po->status}}</td>
                                            <td class="text-right">
                                            <td class="text-right mr-1">

                                                <?php $role = Auth::user()->role; ?>
                                                @if($role == 3)
                                                    <a href="{{ url('grn/create', ['id' => $po->po_id]) }}" class="btn btn-success mr-1" type="button">Create GRN</a>
                                                    <a href="{{ route('po.show', $po->po_id) }}" class="btn btn-primary mr-1" type="button">Generate PDF</a>
                                                @endif
                                            
                                                <?php $role = Auth::user()->role; ?>
                                                @if($role == 2)
                                                <a href="{{ route('po.show', $po->po_id)}} " class="btn btn-primary mr-1" type="button">Detail</a>
                                                @endif

                                            </td>
                                        </tr>
                                        @endif
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
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#po-table1, #po-table2').DataTable({
            responsive: true
        });
    });
</script>
@endpush

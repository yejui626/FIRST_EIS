@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-box-2 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"> Purchase Orders</p>
                                    <p class="card-title">{{ $purchaseOrderCount }}</p>
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-copy-04 text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Pending Purchase Requests</p>
                                    <p class="card-title">{{ $pendingRequestCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Products</p>
                                    <p class="card-title">{{ $productCount }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Our Supplier</p>
                                    <p class="card-title">{{ $supplierCount }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Pending Purchase Request</h5>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table id="pr-table" class="table table-striped">
                                
                                <thead class=" text-primary">
                                    <th>
                                        PR ID
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Supplier 
                                    </th>
                                    <th>
                                        Requested By
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        
                                    </th>
                                    
                                    
                                </thead>
                                
                                <tbody>
                                    @foreach($purchaserequest as $pr)
                                    @if($pr->status == 'Pending')
                                    <tr>
                                        <td>
                                        {{$pr->id}}  
                                        </td>
                                        <td>
                                        {{$pr->status}}
                                        </td>
                                        <td>
                                        {{$pr->supplier->supplier_name}}
                                        </td>
                                        <td>
                                        {{$pr->requestor}}
                                        </td>
                                        <td>
                                        {{$pr->created_at}}
                                        </td>

                                        <td class="text-right mr-1 d-flex justify-content-end">
                                        <?php $role = Auth::user()->role; ?>
                                        @if($role == 2)
                                        <!-- Pop-up Button -->
                                        <button class="btn btn-secondary mr-1" type="button" data-toggle="modal" data-target="#popup-{{ $pr->id }}">
                                            Update Status
                                        </button>
                                        @endif
                                        <!-- Pop-up Content -->
                                        <div class="modal fade" id="popup-{{$pr->id}}" tabindex="-1" role="dialog" aria-labelledby="popup-{{$pr->id}}-label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('purchaseRequest.updateStatus', $pr->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="status">Status:</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Approved">Approve</option>
                                                                    <option value="Rejected">Reject</option>
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
                                        
                                        
                                        <a href="{{ route('purchaserequest.show', $pr->id) }}" class="btn btn-primary mr-1" type="button">Generate PDF</a>
                                       <?php $role = Auth::user()->role; ?>
                                        @if($role == 3)
                                        <a href="{{ route('purchaserequest.edit', $pr->id) }}" class="btn btn-warning mr-1" role="button">Edit</a>
                                        <form action="{{ route('purchaserequest.destroy', $pr->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Purchase Request?')">Delete</button>
                                    </form>
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
        
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pr-table').DataTable({
            responsive: true
        });
    });
</script>
@endpush


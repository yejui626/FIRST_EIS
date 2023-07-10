@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchaserequest'
])

@section('content')
<style>
    .dataTables_wrapper {
    overflow-x: hidden;}
    </style>
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="role">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                                                        aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                            {{ Session:: get('success' )}}
                        </div>
                        @endif
                        <?php $role = Auth::user()->role; ?>
                                        @if($role == 3)
                    <a href="{{route ('purchaserequest.create')}}" class="btn btn-primary" role="button" style="float: right;"><i class="fa fa-plus"></i> Create New</a>
                    @endif    
                    <h4 class="card-title"> Pending Purchase Request</h4>
                        
 
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table id="pr-table1" class="table table-striped">
                                
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
                                        Date Created
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
                                        <td class="text-warning">
    <b>{{$pr->status}}</b>
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
                                        @endif
                                        
                                        <a href="{{ route('purchaserequest.show', $pr->id) }}" class="btn btn-primary mr-1" type="button">Detail</a>
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
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="pr-table2" class="table table-striped">
                                <h4 class="card-title"> Approved Purchase Request</h4>
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
                                            Requested by 
                                        </th>
                                        <th>
                                            Date Created 
                                        </th>

                                        <th>
                                            
                                        </th>
                                        
                                        
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($purchaserequest as $pr)
                                        @if($pr->status == 'Approved')
                                        <tr>
                                            <td>
                                            {{$pr->id}}  
                                            </td>
                                            <td class="text-success">
    <b>{{$pr->status}}</b>
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
                                            

                                            <td class="text-right mr-1">
                                       <?php $role = Auth::user()->role; ?>
                                        @if($role == 2)
                                            <a href="{{ route('po.createOrder', $pr->id) }}" class="btn btn-success mr-1" type="button">Create Purchase Order</a>
                                        @endif
                                            <a href="{{ route('purchaserequest.show', $pr->id) }}" class="btn btn-primary mr-1" type="button">Generate PDF</a>

                                
                                          <?php $role = Auth::user()->role; ?>
                                        @if($role == 3)
                                            <button class="btn btn-danger">Delete</button>
                                            @csrf
                                            @method('DELETE')
                                            @endif
                                        </form>
                                            
                                        </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="pr-table2" class="table table-striped">
                                <h4 class="card-title"> Rejected Purchase Request</h4>
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
                                            Requested by 
                                        </th>
                                        <th>
                                            Date Created
                                        </th>

                                        <th>
                                            
                                        </th>
                                        
                                        
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($purchaserequest as $pr)
                                        @if($pr->status == 'Rejected')
                                        <tr>
                                            <td>
                                            {{$pr->id}}  
                                            </td>
                                            <td class="text-danger">
    <b>{{$pr->status}}</b>
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

                                            <td class="text-right mr-1">
                                       
                                            <a href="{{ route('purchaserequest.show', $pr->id) }}" class="btn btn-primary mr-1" type="button">Generate PDF</a>

                                
                                          <?php $role = Auth::user()->role; ?>
                                        @if($role == 3)
                                            <button class="btn btn-danger">Delete</button>
                                            @csrf
                                            @method('DELETE')
                                            @endif
                                        </form>
                                            
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
@push('scripts')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pr-table1, #pr-table2').DataTable({
            responsive: true, // Enable responsive mode
            autoWidth: true, // Disable automatic column width calculation
            scrollX: false, // Disable horizontal scrolling
        });
    });
</script>
@endpush
@endsection
   
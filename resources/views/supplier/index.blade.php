@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'supplier'
])

@section('content')

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
                    <a href="{{route ('supplier.create')}}" class="btn btn-primary" role="button" style="float: right;"><i class="fa fa-plus"></i> Add</a>
                        <h4 class="card-title"> Our Suppliers</h4>
                        
 
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table id="supplier" class="table table-striped">
                                
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Supplier Name
                                    </th>
                                    <th>
                                        Phone No.
                                    </th>
                                    
                                    <th>

                                    </th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($supplier as $rs)
                                    <tr>
                                        <td>
                                        {{$rs->id}}  
                                        </td>
                                        <td>
                                        {{$rs->supplier_name}}
                                        </td>
                                        <td>
                                        {{$rs->supplier_phone}}
                                        </td>
                                        
                                        <td class="text-right">
                                        <a href="{{route('supplier.show', $rs->id)}}" class="btn btn-primary mr-1" type="button">Detail</a>
                                        <a href="{{route('supplier.edit', $rs->id)}}" class="btn btn-default mr-1" type="button">Edit</a>
                                        <form action="{{route('supplier.destroy', $rs->id)}}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Confirm deleting supplier?')">
                                        <button class="btn btn-danger">Delete</button>
                                        @csrf
                                        @method('DELETE')
                                        
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
        $('#supplier').DataTable({
            responsive: true
        });
    });
</script>
@endpush
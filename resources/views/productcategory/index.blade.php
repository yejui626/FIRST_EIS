@extends('layouts.app', [
'class' => '',
'elementActive' => 'productcategory'
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
                        {{ Session:: get('success' )}}
                    @elseif (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="role">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        {{ Session:: get('error' )}}
                    </div>
                    @endif
                    <a href="{{ route('productcategory.create') }}" class="btn btn-primary" role="button" style="float: right;"><i class="fa fa-plus"></i> Add</a>
                    <h4 class="card-title"> Product Category</h4>


                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="category" class="table table-striped">

                            <thead class=" text-primary">
                                <th>
                                    No
                                </th>
                                <th>
                                    Category
                                </th>
                                <th width="280px">
                                    Action
                                </th>

                            </thead>
                            <tbody>
                                @foreach($productcategory as $productcategory)
                                <tr>
                                    <td>
                                        {{++$i}}
                                    </td>
                                    <td>
                                        {{$productcategory->category_name}}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('productcategory.edit', $productcategory->category_id) }}">Edit</a>
                                        <form action="{{ route('productcategory.destroy', $productcategory->category_id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Confirm deleting product category?')">
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







@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category').DataTable({
            responsive: true
        });
    });
</script>
@endpush

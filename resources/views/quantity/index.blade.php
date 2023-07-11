@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'quantity'
])

@section('content')
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" />
    <style>
        .dataTables_wrapper .dataTables_filter {
            text-align: right;
        }

        .dataTables_wrapper .sorting:before,
        .dataTables_wrapper .sorting_asc:before,
        .dataTables_wrapper .sorting_desc:before {
            color: black !important;
        }
    </style>
</head>

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
                    </div>
                    @endif
                    
                    <h4 class="card-title"> Inventory List</h4>


                </div>

                <div class="card-body">

                    <div class="table-responsive">
                    <table class="table" id="inventory-table">

                            <thead class=" text-primary">
                                <th data-orderable="true">ID</th>
                                <th></th>
                                <th data-orderable="true">Product Name</th>
                                <th data-orderable="true">Price</th>
                                <th data-orderable="true">Quantity Orders</th>
                                <th data-orderable="true">Quantity In Stock</th>
                                <th data-orderable="true">Quantity Required</th>
                                <th>Status</th>
                                <th></th>

                            </thead>
                            <tbody>
                                @foreach($product as $pr)
                                <tr>
                                    <td>
                                        {{$pr->id}}
                                    </td>
                                    <td>
                                        <img src="{{asset($pr->product_img1)}}" width="120" height="100" class="img img-responsive"></img>
                                    </td>
                                    <td>
                                        {{substr(($pr->product_name),0, 50)}}..
                                    </td>
                                    <td>
                                    {{$pr->product_sellingprice}}
                                    </td>
                                    <td>
                                    {{ $totalOrderCount }}
                                    </td>
                                    <td>
                                    {{$pr->product_quantity}}
                                    </td>
                                    <td>
                                    {{ $totalOrderCount - $pr->product_quantity }}
                                    </td>
                                    <td>
                                        @if ($totalOrderCount < $pr->product_quantity)
                                            In Stock
                                        @elseif ($pr->product_quantity = 0)
                                            <span style="color: red;">Out of Stock</span>
                                        @else
                                            @if ($pr->product_quantity <= 10)
                                                <span style="color: orange;">Low Stock</span>
                                            @else
                                                Stock Level Normal
                                            @endif
                                        @endif
                                    </td>

                            
    
                                    <td class="text-right">
                                        <a href="{{route('quantity.show', $pr->id)}}" class="btn btn-primary mr-1" type="button">Detail</a>
                                        <a href="{{route('quantity.edit', $pr->id)}}" class="btn btn-default mr-1" type="button">Edit</a>
                                    
                                            
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#inventory-table').DataTable({
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
            language: {
                search: "",
                searchPlaceholder: "Search",
            }
        });
    });
</script>
@endpush
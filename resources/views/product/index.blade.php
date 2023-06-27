@extends('layouts.app', [
'class' => '',
'elementActive' => 'product'
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
                    </div>
                    @elseif (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="role">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        {{ Session:: get('error' )}}
                    </div>
                    @endif
                    <a href="{{route ('product.create')}}" class="btn btn-primary" role="button" style="float: right;"><i class="fa fa-plus"></i> Add</a>
                    <h4 class="card-title"> Product List</h4>


                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="product" class="table table-striped">

                            <thead class=" text-primary">
                                <th>
                                    ID
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Product Code
                                </th>

                                <th>
                                    Price
                                </th>
                                    <th>

                                    </th>
                            </thead>
                            <tbody>
                                @foreach($product as $pr)
                                <tr>
                                    <td>
                                        {{$pr->id}}
                                    </td>
                                    <td>
                                        {{$pr->productCategory->category_name}}
                                    </td>
                                    <td>
                                        <img src="{{asset($pr->product_img1)}}" width="120" height="100" class="img img-responsive"></img>
                                    </td>
                                    <td>
                                        {{substr(($pr->product_name),0, 50)}}
                                    </td>
                                    <td>
                                        {{substr(($pr->product_code),0,20)}}
                                    </td>
                                    <td>
                                        {{$pr->product_sellingprice}}
                                    </td>



                                    <td class="text-right">
                                        <a href="{{route('product.show', $pr->id)}}" class="btn btn-primary mr-1" type="button">Detail</a>
                                        <a href="{{route('product.edit', $pr->id)}}" class="btn btn-default mr-1" type="button">Edit</a>
                                        <form action="{{route('product.destroy', $pr->id)}}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Confirm deleting product?')">
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
        $('#product').DataTable({
            responsive: true
        });
    });
</script>
@endpush
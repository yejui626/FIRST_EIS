@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'quantity'
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
                    @endif
                    
                    <h4 class="card-title"> Inventory List</h4>


                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">

                            <thead class=" text-primary">
                                <th>
                                    ID
                                </th>
                                <th>

                                </th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Quantity Orders
                                </th>
                                <th>
                                    Quantity In Stock
                                </th>
                                <th>
                                    Quantity Required
                                </th>
                                <th>
                                    Status
                                </th>


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
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'orderstatus'
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
                    
                        <h4 class="card-title"> Orders</h4>
                        
 
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                
                                <thead class=" text-primary">
                                    <th>
                                        Order ID
                                    </th>
                                    <th>
                                        Customer Name
                                    </th>
                                    <th>
                                        Product Name
                                    </th> 
                                    <th>
                                        Quantity
                                    </th> 
                                    <th>
                                        Total Price
                                    </th> 
                                    <th>
                                        Status
                                    </th> 
                                    <th>
                                        Action
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($order as $od)
                                    <tr>
                                        <td>
                                        {{$od->id}}  
                                        </td>
                                        <td>
                                        {{$od->product_name}}
                                        </td>
                                        <td>
                                        {{$rs->product_quantity}}
                                        </td>
                                        <td>
                                        {{$rs->Status}}
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
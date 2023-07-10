@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])
<style>
    .pagination .page-link {
        font-size: 14px; /* Adjust the font size as needed */
    }
    .card-height {
    height: 150px;
}
</style>
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-shopping-cart text-warning"></i>
                            </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Orders</p>
                                    <p class="card-title">{{ $totalOrderCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> Update Now
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-shopping-bag text-success"></i>
                            </div>


                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Products</p>
                                    <p class="card-title">{{ $productCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        <i class="fa fa-refresh"></i> Update Now
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-paper text-primary"></i>
                            </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Pending Purchase Request</p>
                                    <p class="card-title">{{ $pendingPurchaseRequestCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        <i class="fa fa-refresh"></i> Update Now
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-ruler-pencil text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total GRN</p>
                                    <p class="card-title">{{ $grnCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        <i class="fa fa-refresh"></i> Update Now
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Inventory</h5>
                <p class="card-category">Replenishment Needed</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>ID</th>
                            <th></th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>
                                    Quantity In Stock
                                </th>
                                <th>
                                    Quantity Required
                                </th>
                            
                        </thead>
                        <tbody>
    @foreach($products as $product)
        @if ($product->product_quantity <= 10)
            <tr>
                <td>{{$product->id}}</td>
                <td>
                    <img src="{{asset($product->product_img1)}}" width="120" height="100" class="img img-responsive">
                </td>
                <td>{{substr($product->product_name, 0, 50)}}..</td>
                <td>{{$product->product_sellingprice}}</td>
                <td>{{$product->product_quantity}}</td>
                <td>{{ $totalOrderCount - $product->product_quantity }}</td>
                
                <td class="text-right">
                    <a href="{{route('quantity.show', $product->id)}}" class="btn btn-primary mr-1" type="button">Detail</a>
                    <a href="{{route('quantity.edit', $product->id)}}" class="btn btn-default mr-1" type="button">Edit</a>
                    <a href="{{ route('purchaseRequest.createwithproduct', ['product_id' => $product->id]) }}" class="btn btn-success mr-1" type="button">Purchase</a>
                    <!-- Additional actions or buttons -->
                </td>
            </tr>
        @endif
    @endforeach
</tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
            <div class="text-right">
    <ul class="pagination">
        @if ($products->currentPage() > 1)
            <li class="page-item">
                <a href="{{ $products->previousPageUrl() }}" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        @endif

        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <li class="page-item{{ $i === $products->currentPage() ? ' active' : '' }}">
                <a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a>
            </li>
        @endfor

        @if ($products->currentPage() < $products->lastPage())
            <li class="page-item">
                <a href="{{ $products->nextPageUrl() }}" class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        @endif
    </ul>
</div>


     
@endsection

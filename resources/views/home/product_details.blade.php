<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>TSK E-Commerce Shopping</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home//css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @if(session('role') == '5')
        @include ('home.headerafter')
        @else
        @include ('home.header')
        @endif



        <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%; padding:30px;">
            <div class="img-box">
                <img src="{{$products->product_img1}}" style="width: 100%; max-height: 400px; padding: 40px;" alt="">
            </div>
            <div class="detail-box">
                <h5>
                    {{$products->product_name}}
                </h5>
                <h5>Quantity: {{ $products->product_quantity }}
                </h5>
                <h6>
                    Price: {{$products->product_sellingprice}}
                </h6>
                <h6>
                    Product Code: {{$products->product_code}}
                </h6>
                <h6>
                    {{$products->product_details}}
                </h6>
                <div style="display: flex; justify-content: center;">
                    <form action="{{ route('add_cart_details', $products->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="number" name="quantity" value="1" min="1" max="{{$products->product_quantity}}" style="width: 60px;">
                                <!-- Use $product->quantity->quantity_product to access the quantity_product property -->
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="Add to Cart">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer start -->
    @include ('home.footer')
    <!-- footer end -->

    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
<!-- Your CSS and JS imports -->
<!DOCTYPE html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}" type="">
    <title>TSK E-Commerce Shopping</title>
    <!-- bootstrap core css -->
    <link rel=" stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include ('home.headerafter')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        @php
                        $pr = $payment->first();
                        @endphp
                        @if ($pr)
                        <tr>
                            <th>Payment ID</th>
                            <td>{{ $pr->id }}</td>
                        </tr>
                        <tr>
                            <th>Payment Date Time</th>
                            <td>{{ $pr->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Name on Card Payment</th>
                            <td>{{ $pr->payment_name }}</td>
                        </tr>
                        <tr>
                            <th>Card Number</th>
                            <td>{{ $pr->payment_card }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <a class="btn btn-warning" href="{{url('orderhistory')}}">back</a>
    </div>
    <!-- footer end -->

    <!-- jQery -->
    <!-- jQery -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('home/js/custom.js') }}"></script>
</body>
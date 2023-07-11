<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .company-details {
            text-align: right;
            font-size: 15px;
        }

        .invoice-line {
            border-top: 1px solid black;
            margin-bottom: 20px;
        }

        .order-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-id {
            text-align: right;
        }

        .table_deg {
            border: 2px solid black;
            margin: auto;
            text-align: center;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            font-size: 15px;
        }

        .butt_deg {
            text-align: center;
            margin-bottom: 20px;
        }

        .note-remark {
            margin-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}" type="">
    <title>TSK E-Commerce Shopping</title>
</head>

<body>
    <div class="container">
        <div class="hero_area">
            @include ('home.headerafter')
            <!-- header section strats -->
            <div class="main-panel">
                <main class="page payment-page">
                    <section class="clean-block payment-form dark">
                        <div class="container2">
                            <div class="block-heading">
                                <h2 class="text-info" align=center>Edit Address Details</h2>
                            </div>

                            @if (Session::has('fail'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('fail') }}</p>
                            </div>
                            @endif

                            <form method="POST" action="{{ route('saveeditAddress') }}">
                                @csrf
                                <div class="error hide">
                                    <div class="alert" align="center"></div>
                                </div>
                                <input type="hidden" name="id" value="{{ $address->id }}">
                                <div class="card-details">
                                    <h3 class="title">Delivery Address</h3>
                                    <div class='row'>
                                        <div class='col-sm-12 form-group required'>
                                            <label class='control-label'>Delivery Address</label>
                                            <input type="text" id="address" name="address" value="{{ $address->address }}" required size="4">
                                        </div>
                                    </div>
                                    <div class='form-row row'>
                                        <div class='col-sm-12 form-group required'>
                                            <label class='control-label'>Phone Number</label>
                                            <input type="text" id="phone_number" name="phone_number" value="{{ $address->phone_number }}" required size="4">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-block w-100" type="submit">Save Address</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>

    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <script src="{{ asset('home/js/custom.js') }}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('assets/js/vanilla-zoom.js')}}"></script>
    <script src="{{asset('assets/js/theme.js')}}"></script>
</body>

</html>
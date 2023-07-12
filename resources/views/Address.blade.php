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
      <form action="{{ route('saveCartDetails') }}" method="POST">
         @csrf
         <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" placeholder="Enter address" name="address">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
         </div>
         <div class="form-group">
            <label for="text">Phone Number</label>
            <input name="phone" class="form-control" placeholder="Enter phone number">
         </div>
         <input type="hidden" name="id" value="{{ $id }}">
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <div class="card-body">
         <div class="table-responsive">
            <table class="table">
               <thead class=" text-primary">
                  <th>
                     Address
                  </th>
                  <th>
                     Phone
                  </th>
               </thead>
               <tbody>
                  @php
                  $pr = $cust->first();
                  @endphp
                  <tr>
                     <td>
                        {{$pr->address}}
                     </td>
                     <td>
                        {{$pr->phone}}
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <a class="btn btn-warning" href="{{url('show_cart')}}">back</a>
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
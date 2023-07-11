<!DOCTYPE html>
<html>

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
   <link rel="shortcut icon" href="images/favicon.png" type="">
   <title>TSK E-Commerce Shopping</title>
   <!-- bootstrap core css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
   <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

   <style type="text/css">
      .invoice-header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         margin-bottom: 20px;
      }

      .company-details {
         text-align: right;
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
      }

      .butt_deg {
         text-align: center;
         margin-bottom: 20px;
      }


      .note-remark {
         margin-bottom: 20px;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="hero_area">
         <!-- header section strats -->
         @include ('home.headerafter')
         <div class="main-panel">
            <div class="content-wrapper">
               <div class="invoice-header">
                  <div class="company-logo">
                     <img width="300" src="/storage/images/logo.png" alt="Company Logo">
                  </div>
                  <div class="company-details">
                     <h3>TSK SYNERGY SDN BHD</h3>
                     <p>NO. 19, JALAN MEGA 1/8 TAMAN PERINDUSTRIAN NUSA CEMERLANG 79200 ISKANDAR PUTERI JOHOR.</p>
                     <p>TEL: 07-5950803</p>
                  </div>
               </div>
               <table class="table_deg">
                  <thead>
                     <tr class="th_deg">
                        <th style="padding:10px;">#</th>
                        <th style="padding:10px;">ITEM CODE | PART NUMBER</th>
                        <th style="padding:10px;">CUST-PO</th>
                        <th style="padding:10px;">PROJECT</th>
                        <th style="padding:10px;">QTY</th>
                        <th style="padding:10px;">UOM</th>
                        <th style="padding:10px;">UNIT</th>
                        <th style="padding:10px;">AMOUNT</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $totalprice = 0.00;
                     $totalpriceTax = 0.00;
                     $tax = 0;
                     $number = 0;
                     ?>
                     @foreach($products as $product)
                     @foreach($cart as $cartItem)
                     @if($cartItem->product_id === $product->id)
                     <?php $number += 1; ?>
                     <tr>
                        <td>{{$number}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>23050057-NO PO-1684456586</td>
                        <td>NONE</td>
                        <td>{{$cartItem->product_quantity}}</td>
                        <td>UOM</td>
                        <td>RM{{$product->product_sellingprice}}</td>
                        <td>RM{{$product->product_sellingprice*$cartItem->product_quantity}}</td>
                        <?php
                        $totalprice += ($product->product_sellingprice * $cartItem->product_quantity);
                        $totalpriceTax = (($totalprice * $tax) + $totalprice);
                        ?>
                     </tr>
                     @endif
                     @endforeach
                     @endforeach
                     <tr>
                        <td colspan="6"></td>
                        <td style="text-align: center; font-weight: bold; ">Total Price:</td>
                        <td style="font-weight: bold;">RM{{$totalprice}}</td>
                     </tr>
                     <tr>
                        <td colspan="6"></td>
                        <td style="text-align: center; font-weight: bold; ">Tax:</td>
                        <td style="font-weight: bold;">{{$tax*100}}%</td>
                     </tr>
                     <tr>
                        <td colspan="6"></td>
                        <td style="text-align: center; font-weight: bold; ">Total Price TAX:</td>
                        <td style="font-weight: bold;">RM{{$totalpriceTax}}</td>
                     </tr>
                  </tbody>
               </table>

               <div class="butt_deg">
                  <h1>Proceed to Checkout</h1>
                  @php
                  $token = encrypt($cartItem->user_id.'/'.$cartItem->id.'/'.$totalprice);
                  session(['stripe_data' => [
                  'id' => $cartItem->user_id,
                  'cid' => $cartItem->id,
                  'totalprice' => $totalprice
                  ]]);
                  @endphp

                  <a class="btn btn-primary" href="{{ url('stripe/'.$token) }}">Pay</a>
                  <a class="btn btn-secondary" href="{{ url('print_pdf', $cartItem->id)}}">Generate Invoice</a>
               </div>
            </div>
         </div>
      </div>


      <!-- footer end -->

      <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <script src="{{ asset('home/js/custom.js') }}"></script>

</body>

</html>
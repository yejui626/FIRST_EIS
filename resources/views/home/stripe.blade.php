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
   <link rel=" stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
   <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

   <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}" type="">
   <title>Famms - Fashion HTML Template</title>
</head>

<body>
   <div class="container">
      <div class="hero_area">
         @include ('home.headerafter')
         <!-- header section strats -->
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

            </div>

            <main class="page payment-page">
               <section class="clean-block payment-form dark">
                  <div class="container2">
                     <div class="block-heading">
                        <h2 class="text-info" align=center>Payment Details</h2>
                     </div>

                     @if (Session::has('fail'))
                     <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('fail') }}</p>
                     </div>
                     @endif

                     <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="cid" value="{{ $cid }}">
                        <input type="hidden" name="totalprice" value="{{ $totalprice }}">
                        @csrf
                        <div class="error hide">
                           <div class="alert" align="center"></div>
                        </div>
                        <div class="card-details">
                           <h3 class="title">Credit Card Details</h3>
                           <div class='row'>
                              <div class='col-sm-12 form-group required'>
                                 <label class='control-label'>Delivery Address</label> <input class='form-control' size='4' type='text' name="address">
                              </div>
                           </div>
                           <div class='form-row row'>
                              <div class='col-sm-12 form-group required'>
                                 <label class='control-label'>Phone Number</label> <input class='form-control' size='4' type='text' name="phone">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-7">
                                 <div class="mb-3"><label class="form-label" for="card_holder">Card Holder</label><input class="form-control" type="text" id="card_holder" placeholder="Card Holder" name="cardname"></div>
                              </div>
                              <div class="col-sm-5">
                                 <div class="mb-3"><label class="form-label">Expiration date</label>
                                    <div class="input-group expiration-date"><input class="form-control card-expiry-month" type="text" placeholder="MM" name="expiration_month"><input class="form-control card-expiry-year" type="text" placeholder="YYYY" name="expiration_year"></div>
                                 </div>
                              </div>
                              <div class="col-sm-7">
                                 <div class="mb-3"><label class="form-label" for="card_number">Card Number</label><input class="form-control card-number" type="text" id="card_number" placeholder="Card Number" name="cardnumber"></div>
                              </div>
                              <div class="col-sm-5">
                                 <div class="mb-3"><label class="form-label" for="cvc">CVC</label><input class="form-control card-cvc" type="text" id="cvc" placeholder="CVC" name="cvc"></div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Proceed</button></div>
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
</body>

<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>

<script src="{{ asset('home/js/popper.min.js') }}"></script>

<script src="{{ asset('home/js/bootstrap.js') }}"></script>

<script src="{{ asset('home/js/custom.js') }}"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/baguetteBox.min.js')}}"></script>
<script src="{{asset('assets/js/vanilla-zoom.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>

<script type="text/javascript">
   $(function() {



      $('#payment-form').submit(function(event) {
         // Get the actual total price from the hidden input field
         var actualTotalPrice = parseFloat($('#actual-total-price').val());

         // Get the entered total price from the form
         var enteredTotalPrice = parseFloat($('#total-price-input').val());

         // Compare the actual total price with the entered total price
         if (enteredTotalPrice !== actualTotalPrice) {
            // Total price has been modified, prevent form submission and show an error message
            event.preventDefault();
            $('#error-message').text('Invalid total price').show();
            return false;
         }

         // Total price is valid, allow form submission
         return true;
      });

      /*------------------------------------------
      --------------------------------------------
      Stripe Payment Code
      --------------------------------------------
      --------------------------------------------*/

      var $form = $(".require-validation");

      $('form.require-validation').bind('submit', function(e) {
         var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
               'input[type=text]', 'input[type=file]',
               'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
         $errorMessage.addClass('hide');

         $('.has-error').removeClass('has-error');
         $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
               $input.parent().addClass('has-error');
               $errorMessage.removeClass('hide');
               e.preventDefault();
            }
         });

         if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
               number: $('.card-number').val(),
               cvc: $('.card-cvc').val(),
               exp_month: $('.card-expiry-month').val(),
               exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
         }

      });

      /*------------------------------------------
      --------------------------------------------
      Stripe Response Handler
      --------------------------------------------
      --------------------------------------------*/
      function stripeResponseHandler(status, response) {
         if (response.error) {
            $('.error')
               .removeClass('hide')
               .find('.alert')
               .text(response.error.message);
         } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();


            $.ajax({
               url: '/receipt/{{$id}}/mail',
               method: 'GET',
               success: function(response) {
                  console.log('Email sent successfully!');
               },
               error: function(xhr, status, error) {
                  console.error('Error sending email:', error);
               }
            });

            $form.get(0).submit();

         }
      }

   });
</script>

</html>
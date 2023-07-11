<!--  -->


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>Shopping Cart - Brand</title>
   <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/baguetteBox.min.css">
   <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
   <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
   <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
   <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />


</head>

<style>
   .confirm-modal-title {
      font-size: 18px;
      /* Adjust the font size to your preference */
   }

   .confirm-modal-text {
      font-size: 16px;
      /* Adjust the font size to your preference */
   }
</style>

<body>
   @include('home.headerafter')
   <main class="page shopping-cart-page">
      <section class="clean-block clean-cart dark">
         <div class="container">
            <div class="block-heading">
               <h2 class="text-info">Shopping Cart</h2>
               <p>"Inside your cart, discover your handpicked treasures waiting to be claimed."</p>
            </div>
            <div class="content" style="font-size: 20px;">
               <div class="row g-0">
                  <div class="col-md-12 col-lg-8">
                     <div class="items">
                        <?php $totalprice = 0; ?>
                        @foreach($products as $product)
                        @foreach($cart as $cartItem)
                        @if($cartItem->product_id === $product->id)
                        <div class="product">
                           <div class="row justify-content-center align-items-center">
                              <div class="col-md-3">
                                 <div class="product-image"><img class="img-fluid d-block mx-auto image" src="{{$product->product_img1}}"></div>
                              </div>
                              <div class="col-md-5 product-info"><a class="product-name" href="#">{{$product->product_name}}</a>
                                 <div class="product-specs">
                                    <div><span>Price:&nbsp;</span><span class="value">{{$product->product_sellingprice}}</span></div>
                                    <div><span>Quantity:&nbsp;</span><span class="value">{{$cartItem->product_quantity}}</span></div>
                                 </div>
                              </div>
                              <div class="apa">
                                 <div class="col-6 col-md-2 offset-xxl-0 price">
                                    <span>RM{{$cartItem->product_quantity * $product->product_sellingprice}}</span>
                                    <span></span>
                                 </div>
                                 <div class="col-6 col-md-2 offset-xxl-8 price">
                                    <button class="btn btn-danger lain" data-toggle="modal" data-target="#confirmModal{{$cartItem->id}}">Remove</button>
                                    <span></span>
                                 </div>
                              </div>

                              <!-- Confirmation Modal -->
                              <div class="modal fade" id="confirmModal{{$cartItem->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel{{$cartItem->id}}" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title confirm-modal-title" id="confirmModalLabel{{$cartItem->id}}">Confirm Removal</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p class="confirm-modal-text">Are you sure you want to remove this item from the cart?</p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <a class="btn btn-danger" href="{{url('/remove_cart',$cartItem->id)}}">Remove</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php $totalprice += ($product->product_sellingprice * $cartItem->product_quantity); ?>
                        @endif
                        @endforeach
                        @endforeach
                     </div>

                     <div class="center" align=center>
                        @if($cart->isEmpty())
                        <p>No items in the cart.</p>
                        @else
                        <div>
                           @php
                           $a = $cart->first(); // Assuming $cart is a collection
                           @endphp
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-4">
                     <div class="summary">
                        <h3>Summary</h3>
                        <h4><span class="text">Subtotal</span><span class="price">RM{{$totalprice}}</span></h4>
                        <h4><span class="text">Discount</span><span class="price">RM0</span></h4>
                        <h4><span class="text">Shipping</span><span class="price">RM0</span></h4>
                        <h4><span class="text">Total</span><span class="price">RM{{$totalprice}}</span></h4>
                        @php
                        $token = '';
                        if (!$cart->isEmpty()) {
                        $cartItem = $cart->first();
                        $token = encrypt($cartItem->user_id.'/'.$cartItem->id.'/'.$totalprice);
                        session(['stripe_data' => [
                        'id' => $cartItem->user_id,
                        'cid' => $cartItem->id,
                        'totalprice' => $totalprice
                        ]]);
                        }
                        @endphp
                        @if (!$cart->isEmpty())
                        <a class="btn btn-primary btn-lg d-block w-100" href="{{ url('stripe/'.$token) }}">Checkout</a>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      @include('home.footer')

   </main>
   <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
   <!-- popper js -->
   <script src="{{ asset('home/js/popper.min.js') }}"></script>
   <!-- bootstrap js -->
   <script src="{{ asset('home/js/bootstrap.js') }}"></script>
   <!-- custom js -->
   <script src="{{ asset('home/js/custom.js') }}"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/js/baguetteBox.min.js"></script>
   <script src="assets/js/vanilla-zoom.js"></script>
   <script src="assets/js/theme.js"></script>


</body>

</html>
<style>
   .fixed-box {
      max-height: 400px;
      /* Adjust the value as per your requirement */
   }
</style>

<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Our <span>products</span>
         </h2>
      </div>

      @if(session('success'))
      <div class="alert alert-success">
         {{ session('success') }}
      </div>
      @endif

      <div class="row">
         @foreach($products as $product)
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box fixed-box"> <!-- Added the "fixed-box" class here -->
               <div class="option_container">
                  <div class="options">
                     <a href="{{url('product_details',$product->id)}}" class="option1">
                        Product Details
                     </a>
                     <form action="{{ url('add_cart', $product->id) }}" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-md-4">
                              <input type="number" name="quantity" value="1" min="1" max="{{$product->product_quantity}}" style="width: 60px;">
                              <!-- Use $product->quantity->quantity_product to access the quantity_product property -->
                           </div>
                           <div class="col-md-4">
                              <input type="submit" value="Add to Cart">
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="img-box">
                  <img src="{{$product->product_img1}}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     {{$product->product_name}}
                  </h5>
                  <h6>
                     RM{{$product->product_sellingprice}}
                  </h6>
               </div>
            </div>
         </div>
         @endforeach

      </div>
</section>
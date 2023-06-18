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
   <title>Famms - Fashion HTML Template</title>
   <!-- bootstrap core css -->
   <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
   <!-- font awesome style -->
   <link href="home/css/font-awesome.min.css" rel="stylesheet" />
   <!-- Custom styles for this template -->
   <link href="home/css/style.css" rel="stylesheet" />
   <!-- responsive style -->
   <link href="home/css/responsive.css" rel="stylesheet" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
         $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
               type: 'GET',
               url: "{{ route('searchdata') }}", // Update the route name here
               data: {
                  'search': query
               },
               success: function(data) {
                  $('#search_list').html(data);
               }
            });
         });
      });
   </script>
</head>

<body>

   <!-- header section strats -->
   @if(session('role') == '5')
   @include ('home.headerafter')
   @else
   @include ('home.header')
   @endif


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
         </li>
         @if(session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
         @endif
         <div class="form-inline">
            <div class="input-group">
               <input type="text" class="form-control" id="search" placeholder="Search">
               <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
               </div>
            </div>
         </div>

         <div id="search_list">
            <!-- Display search results here -->
         </div>


         <span style="padding-top: 20px;">
            {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
         </span>
      </div>
   </section>


   <!-- footer start -->
   @include ('home.footer')
   <!-- footer end -->
   <div class="cpy_">
      <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

         Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

      </p>
   </div>
   <!-- jQery -->
   <script src="home/js/jquery-3.4.1.min.js"></script>
   <!-- popper js -->
   <script src="home/js/popper.min.js"></script>
   <!-- bootstrap js -->
   <script src="home/js/bootstrap.js"></script>
   <!-- custom js -->
   <script src="home/js/custom.js"></script>

   <!DOCTYPE html>
   <html>

   <head>
      <!-- Rest of the code -->
   </head>

   <body>
      <!-- Rest of the code -->

      <!-- Rest of the HTML code -->
      <script>
         $(document).ready(function() {
            var currentPage = 1; // Initialize the current page number
            var query = ''; // Initialize the current search query
            var delayTimer; // Timer for delaying the AJAX request

            $('#search').on('keyup', function() {
               clearTimeout(delayTimer); // Clear the previous timer

               query = $(this).val();
               currentPage = 1; // Reset the current page to 1 when a new search query is entered

               delayTimer = setTimeout(function() {
                  loadProducts(query, currentPage); // Call the function to load products with the query and page parameters
               }, 300); // Delay the AJAX request by 300 milliseconds
            }).keyup(); // Trigger initial search on page load

            // Pagination click event
            $(document).on('click', '.pagination a', function(e) {
               e.preventDefault();
               var page = $(this).attr('href').split('page=')[1]; // Get the page number from the URL
               currentPage = parseInt(page); // Update the current page to the clicked page number
               loadProducts(query, currentPage); // Call the function to load products with the updated page parameter
            });

            function loadProducts(query, page) {
               $.ajax({
                  type: 'GET',
                  url: "{{ route('searchdata') }}",
                  data: {
                     'search': query,
                     'page': page // Pass the current page number in the AJAX request
                  },
                  success: function(response) {
                     $('#search_list').html(response.output);
                     $('.pagination').html(response.pagination); // Update the pagination links
                  },
                  error: function() {
                     $('#search_list').html('<h2>Error occurred</h2>');
                  }
               });
            }
         });
      </script>




   </body>



   </html>
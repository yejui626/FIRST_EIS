<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>E-commerce</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <!-- Include jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <!-- Include Bootstrap JS -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <!-- font awesome style -->
   <link href="home/css/font-awesome.min.css" rel="stylesheet" />
   <!-- Custom styles for this template -->
   <link href="home/css/style.css" rel="stylesheet" />
   <!-- responsive style -->
   <link href="home/css/responsive.css" rel="stylesheet" />
</head>
@include('home.headerafter')

<body>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <h1 class="text-center">Order History</h1>
            <hr>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="row">
               <div class="col-6">
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                     </div>
                     <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                  </div>
               </div>
               <div class="col-6">
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                     </div>
                     <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                  </div>
               </div>
            </div>
            <div>
               <button id="filter" class="btn btn-primary">Filter</button>
               <button id="reset" class="btn btn-warning">Reset</button>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="table-responsive">
               <table class="display" id="records" style="width:100%">
                  <thead>
                     <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Delivery Status</th>
                        <th>Date Ordered</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
   <!-- Datepicker -->
   <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   <!-- Datatables -->
   <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
   <!-- Momentjs -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
   <script>
      $(function() {
         $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
         });
         $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
         });
      });

      // Fetch records
      function fetch(start_date, end_date) {
         $.ajax({
            url: "{{ route('orderhistory/records') }}",
            type: "GEt",
            data: {
               start_date: start_date,
               end_date: end_date
            },
            dataType: "json",
            success: function(data) {
               // Datatables
               var i = 1;
               $('#records').DataTable({
                  "data": data.order,
                  // responsive
                  "responsive": true,
                  "columns": [{
                        "data": "id"
                     },
                     {
                        "data": "totalprice",
                        "render": function(data, type, row, meta) {
                           return `RM${row.totalprice}`;
                        }
                     },
                     {
                        "data": "delivery_status"
                     },
                     {
                        "data": "created_at",
                        "render": function(data, type, row, meta) {
                           return moment(row.created_at).format('DD-MM-YYYY');
                        }
                     },
                     {
                        "data": null,
                        "render": function(data, type, row, meta) {
                           return `<button class="btn btn-primary" data-toggle="modal" data-target="#myModal${row.id}">Payment Details</button>
        <div class="modal fade" id="myModal${row.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Payment Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Payment ID: ${row.payment.id}</p>
                        <p>Card Name: ${row.payment.cardname}</p>
                        <p>Card Number: ${row.payment.cardnumber}</p>
                        <p>Address: ${row.payment.address}</p>
                        <p>Phone: ${row.payment.phone}</p>
                        <p>Created At: ${row.payment.created_at}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-secondary" data-toggle="modal" data-target="#myModals${row.id}">Order Items</button>
         <div class="modal fade" id="myModals${row.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="myModalLabel">Order Items</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     ${row.items.map(item => `
                        <p>Product Name: ${item.product_name}</p>
                        <p>Product Selling Price: ${item.product_sellingprice}</p>
                        <p>Product Quantity: ${item.product_quantity}</p>
                        <p>Total Price: ${item.total_price}</p>
                        <p>Images:</p>
                        ${item.product_images.map(image => `
                           <img src="${image}" alt="Product Image" width=150>
                        `).join('')}
                        <hr>
                     `).join('')}
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </div>`;
                        }
                     }


                  ]

               });
            }
         });
      }

      fetch();

      // Filter
      $(document).on("click", "#filter", function(e) {
         e.preventDefault();
         var start_date = $("#start_date").val();
         var end_date = $("#end_date").val();
         if (start_date == "" || end_date == "") {
            alert("Both date required");
         } else {
            $('#records').DataTable().destroy();
            fetch(start_date, end_date);
         }
      });

      // Reset
      $(document).on("click", "#reset", function(e) {
         e.preventDefault();
         $("#start_date").val('');
         $("#end_date").val('');
         $('#records').DataTable().destroy();
         fetch();
      });
   </script>
</body>

</html>
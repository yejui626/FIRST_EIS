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
            <h1 class="text-center">My addresses</h1>
            <hr>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="mt-3">
               <a href="{{ route('addAddress') }}" class="btn btn-primary">Add</a>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="table-responsive mt-3">
               <table class="table">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($address as $addresses)
                     @if($addresses->u_id == Auth::user()->id) <!-- Updated this line -->
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $addresses->address }}</td>
                        <td>{{ $addresses->phone_number }}</td>
                        <td>
                           <a href="{{ route('editAddress', ['id' => $addresses->id]) }}" class="btn btn-secondary">Edit</a>
                           <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal-{{ $addresses->id }}">Delete</button>
                           <div class="modal fade" id="confirmDeleteModal-{{ $addresses->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $addresses->id }}" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $addresses->id }}">Delete Confirmation</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <p>Are you sure you want to delete this address?</p>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                       <a href="{{ route('deleteAddress', ['id' => $addresses->id]) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @endif <!-- Updated this line -->
                     @endforeach
                  </tbody>
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
</body>

</html>
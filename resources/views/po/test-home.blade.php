@extends('layouts.app', [
'class' => '',
'elementActive' => 'po'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


<div class="container">
  <h2>Basic Table</h2>
  <p>The .table class adds basic styling (light padding and horizontal dividers) to a table:</p>            
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th><a href="javascript:;" class="btn btn-info addRow">Add</a></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><select name="quantity_productid" placeholder="Select a Product">
                            <option value="none" selected disabled hidden>Select a Product</option>
        @foreach($product as $p)
            <option value="{{ $p->id }}">{{ $p->product_name }}</option>
        @endforeach
    </select></td>
        <td>Doe</td>
        <td>john@example.com</td>
        
      </tr>
      
    </tbody>
  </table>
</div>

<script>
  $('thead').on('click', '.addRow', function(){
    var tr = '<tr>'+
        '<td><select name="quantity_productid" placeholder="Select a Product"><option value="none" selected disabled hidden>Select a Product</option>@foreach($product as $p)<option value="{{ $p->id }}">{{ $p->product_name }}</option>@endforeach</select></td>'+
        '<td>Doe</td>'+
        '<td>john@example.com</td>'+
        '<td><a href="javascript:;" class="btn btn-danger deleteRow">Del</a></td>'+
      '</tr>';

      $('tbody').append(tr);
  });

  $('tbody').on('click', '.deleteRow', function(){
    $(this).parent().parent().remove();
  });
  </script>

</body>
</div>
</div>
</div>
</div>
@endsection
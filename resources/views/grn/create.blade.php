@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'grn'
])

@section('content')

<body>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4>Create GRN</h4>
                    </div>
                    <div class="card-body ">
                        <form method="POST" action="{{ route('grn.store') }}">
                            @csrf  
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="grn_number">GRN Number</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="grn_number">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="purchase_order_no">Purchase Order Number</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="purchase_order_no" value="{{$purchaseorder->po_no}}"readonly> 
                                </div>
                            </div>
                            <input type="hidden" name="po_id" value="{{ request('id') }}">
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"for="to_grn">To</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="to_grn" id="to_grn">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="recipient_grn">Recipient</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="recipient_grn" id="recipient_grn">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="supplier_id">Supplier</label>
                                <div class="col-md-5">
                                    <select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2" aria-label="Default select example">
                                        <option selected disabled>Choose Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{$supplier->supplier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">           
                                <div class="col-md-12">
                                    <button type="button" class="add-item float-end btn btn-primary" name="add" id="add" style="float: right;">Add Item</button>
                                    <table class="table table-striped table-bordered" id="table">
                                        <colgroup>
                                            <col width="4%">
                                            <col width="2%">
                                            <col width="30%">
                                            <col width="10%">
                                            <col width="7%">
                                            <col width="10%">
                                            <col width="17%">
                                            <col width="20%">
                                        </colgroup>
                                        <thead>
                                            <tr class="bg-navy disabled">
                                                <th class="px-1 py-1 text-center"></th>
                                                <th class="px-1 py-1 text-center">#</th>
                                                <th class="px-1 py-1 text-center">Item Name</th>
                                                <th class="px-1 py-1 text-center">Received Date</th>
                                                <th class="px-1 py-1 text-center">Cust Delivery Date</th>
                                                <th class="px-1 py-1 text-center">Qty</th>
                                                <th class="px-1 py-1 text-center">UOM</th>
                                                <th class="px-1 py-1 text-center">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="pr-item" data-id="">   
                                                <td class="align-middle p-1 text-center"></td>
                                                <td class="align-middle p-0 text-center">
                                                    1
                                                </td>
                                                
                                                <td class="align-middle p-1">
                                                    <select name="product_id[]" class="custom-select custom-select-sm rounded-0 select2 product-select" aria-label="Default select example">
                                                        <option selected disabled>Choose Product</option>
                                                        @foreach($product as $row)
                                                            <option value="{{$row->id}}">{{$row->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            
                                                <td class="align-middle p-1">
                                                    <input type="date" class="form-control form-control-sm rounded-0" name="received_date">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="date" class="form-control form-control-sm rounded-0" name="custdelivery_date">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="number" class="form-control form-control-sm rounded-0 product_quantity" name="qty[]" min="1">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <select name="product_uom[]" class="custom-select custom-select-sm rounded-0 select2">
                                                    <option selected="" disabled="">Choose UOM</option>
                                                    <option value="unit">unit</option>
                                                    <option value="EA">EA</option>
                                                    <option value="bag">bag</option>
                                                    <option value="BKT">BKT</option>
                                                    <option value="BND">BND</option>
                                                    <option value="BX">BX</option>
                                                    <option value="CM">CM</option>
                                                    <option value="CTN">CTN</option>
                                                    </select>
                                                </td>                                                
                                                <td class="align-middle p-1">
                                                    <input type="text" class="form-control form-control-sm rounded-0 total" name="description[]">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <button type="button" class="remove-table-row btn btn-sm btn-danger">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr class="bg-lightblue">
                                            <tr>
                                                <th class="p-1 text-right" colspan="7"><span></span>
                                                Total Quantity</th>
                                                <th class="p-1 text-right" id="total_quantity" name="total_quantity">0</th>
                                            </tr>
                                            
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                </div>
                            

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-flat btn-default" href="{{ route('grn.index') }}">Cancel</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Counter for row numbers
        var rowCounter = 1;

        // Add item to the table
        function addItem() {
            var newRow = `
                <tr class="pr-item" data-id="${rowCounter}">
                    <td class="align-middle p-1 text-center"></td>
                    <td class="align-middle p-0 text-center">${rowCounter}</td>
                    <td class="align-middle p-1">
                        <select name="product_id[]" class="custom-select custom-select-sm rounded-0 select2 product-select" aria-label="Default select example">
                            <option selected disabled>Choose Product</option>
                            @foreach($product as $row)
                                <option value="{{$row->id}}">{{$row->product_name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="align-middle p-1">
                        <input type="date" class="form-control form-control-sm rounded-0" name="received_date">
                    </td>
                    <td class="align-middle p-1">
                        <input type="date" class="form-control form-control-sm rounded-0" name="custdelivery_date">
                    </td>
                    <td class="align-middle p-1">
                    <input type="number" class="form-control form-control-sm rounded-0 product_quantity" name="qty[]" min="1">
                    </td>
                    <td class="align-middle p-1">
                        <select name="product_uom[]" class="custom-select custom-select-sm rounded-0 select2">
                        <option selected="" disabled="">Choose UOM</option>
                        <option value="unit">unit</option>
                        <option value="EA">EA</option>
                        <option value="bag">bag</option>
                        <option value="BKT">BKT</option>
                        <option value="BND">BND</option>
                        <option value="BX">BX</option>
                        <option value="CM">CM</option>
                        <option value="CTN">CTN</option>
                        </select>
                    </td>                    
                    <td class="align-middle p-1">
                        <input type="text" class="form-control form-control-sm rounded-0 total" name="description[]">
                    </td>
                    <td class="align-middle p-1">
                        <button type="button" class="remove-table-row btn btn-sm btn-danger">X</button>
                    </td>
                </tr>
            `;
            $('#table tbody').append(newRow);
            rowCounter++;

            // Update row numbers
            updateRowNumbers();
        }

        // Update row numbers
        function updateRowNumbers() {
            $('.pr-item').each(function(index) {
                $(this).find('td:eq(1)').text(index + 1);
            });
        }

        // // Calculate total for a row
        // function calculateRowTotal(row) {
        //     var quantity = parseInt(row.find('.product_quantity').val()) || 0;
        //     var unitPrice = parseFloat(row.find('.product_unitprice').val()) || 0;
        //     var total = quantity * unitPrice;
        //     row.find('.total').val(total.toFixed(2));
        // }
        

        // Remove a row from the table
        function removeRow(row) {
            row.remove();
            updateRowNumbers();
            calculateTotalAmount();
        }

        // Event listener for adding an item
        $('.add-item').click(function() {
            addItem();
        });

        // Event listener for removing a row
        $('#table').on('click', '.remove-table-row', function() {
            var row = $(this).closest('tr');
            removeRow(row);
        });

        // Event listener for quantity change
        $('#table').on('change', '.product_quantity', function() {
            var row = $(this).closest('tr');
            calculateRowTotal(row);
            calculateTotalAmount();
        });

        // Event listener for unit price change
        $('#table').on('change', '.product_unitprice', function() {
            var row = $(this).closest('tr');
            calculateRowTotal(row);
            calculateTotalAmount();
        });
    });
</script>

@endsection

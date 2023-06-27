@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchaserequest'
])

@section('content')

<body>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4>Create Purchase Request</h4>
                    </div>
                    <div class="card-body ">
                        <form method="POST" action="{{ route('purchaserequest.store') }}">
                            @csrf  
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Purchase Request ID</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="id" id="id" placeholder="id" value="{{ $id }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Requested By</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="requestor" id="requestor" placeholder="Requestor Name" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Supplier</label>
                                <div class="col-md-5">
                                    <select name="supplier" id="supplier" class="custom-select custom-select-sm rounded-0 select2" aria-label="Default select example" required>
                                        <option selected disabled>Choose Supplier</option>
                                        @foreach($supplier as $row)
                                        <option value="{{ $row->id }}">{{$row->supplier_name}}</option>
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
                                                <th class="px-1 py-1 text-center">Delivery Date</th>
                                                <th class="px-1 py-1 text-center">Qty</th>
                                                <th class="px-1 py-1 text-center">UOM</th>
                                                <th class="px-1 py-1 text-center">Price/Unit (MYR)</th>
                                                <th class="px-1 py-1 text-center">Total</th>
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
                                                         <option value="{{ $lowproduct->id }}" selected>{{ $lowproduct->product_name }}</option>
                                                         @foreach($product as $row)
                                                            <option value="{{$row->id}}">{{$row->product_name}}</option>
                                                         @endforeach
                                                      </select>
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="date" class="form-control form-control-sm rounded-0" name="delivery_date[]">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="number" class="form-control form-control-sm rounded-0 product_quantity" name="product_quantity[]" min="1">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm rounded-0" name="uom[]">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="number" class="form-control form-control-sm rounded-0 product_unitprice" name="product_unitprice[]" min="0">
                                                </td>
                                                
                                                <td class="align-middle p-1">
                                                    <input type="text" class="form-control form-control-sm rounded-0 total" name="total[]" readonly>
                                                </td>
                                                <td class="align-middle p-1">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr class="bg-lightblue">
                                            <tr>
                                                <th class="p-1 text-right" colspan="7"><span></span>
                                                    Sub Total</th>
                                                <th class="p-1 text-right" id="subtotal" name="subtotal">0</th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="7">Discount (%)
                                                    <input type="number" step="any" name="discount_percentage" class="text-right" value="">
                                                </th>
                                                <th class="p-1"><input type="text" class="form-control form-control-sm rounded-0 discount_amount" name="discount_amount" readonly></th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="7">Tax Inclusive (%)
                                                    <input type="number" name="tax_percentage" class="text-right" >
                                                </th>
                                                <th class="p-1">
                                                    <input type="text" class="form-control form-control-sm rounded-0 tax_amount" name="tax_amount" readonly></th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="7">Total</th>
                                                <th class="p-1 text-right" name="total_amount" id="total_amount">0</th>
                                            </tr>
                                            <input type="hidden" name="total_amount" id="total_amount_input">

                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <label for="notes" class="control-label">Notes</label>
                                        <textarea name="notes" id="notes" cols="10" rows="4"
                                            class="form-control rounded-0"></textarea>
                                    </div>

                                </div>
                </div>
                            

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-flat btn-default" href="{{ route('purchaserequest.index') }}">Cancel</a>

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
                        <input type="date" class="form-control form-control-sm rounded-0" name="delivery_date[]">
                    </td>
                    <td class="align-middle p-1">
                        <input type="number" class="form-control form-control-sm rounded-0 product_quantity" name="product_quantity[]" min="1">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm rounded-0" name="uom[]">
                    </td>
                    <td class="align-middle p-1">
                        <input type="number" class="form-control form-control-sm rounded-0 product_unitprice" name="product_unitprice[]" min="0">
                    </td>
                    
                    <td class="align-middle p-1">
                        <input type="text" class="form-control form-control-sm rounded-0 total" name="total[]" readonly>
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

        // Calculate total for a row
        function calculateRowTotal(row) {
            var quantity = parseInt(row.find('.product_quantity').val()) || 0;
            var unitPrice = parseFloat(row.find('.product_unitprice').val()) || 0;
            var total = quantity * unitPrice;
            row.find('.total').val(total.toFixed(2));
        }
        

        // Calculate totalAmount
        function calculateTotalAmount() {
        var totalAmount = 0;
        var discountPercentage = parseFloat($('[name="discount_percentage"]').val()) || 0;
        var taxPercentage = parseFloat($('[name="tax_percentage"]').val()) || 0;

        $('.pr-item').each(function() {
        var quantity = parseFloat($(this).find('.product_quantity').val()) || 0;
        var unitPrice = parseFloat($(this).find('.product_unitprice').val()) || 0;
        var rowTotal = quantity * unitPrice;
        totalAmount += rowTotal;
        });

        var discountAmount = (totalAmount * (discountPercentage / 100)).toFixed(2);
        var taxAmount = (totalAmount * (taxPercentage / 100)).toFixed(2);
        var subTotal = (totalAmount - parseFloat(discountAmount)).toFixed(2);

        $('[name="discount_amount"]').val(discountAmount);
        $('[name="tax_amount"]').val(taxAmount);
        $('#subtotal').text(subTotal);
        $('#total_amount').text(totalAmount.toFixed(2));
        $('#total_amount_input').val(totalAmount.toFixed(2)); // Set the value of the hidden input field
        }

        // Add an event listener to relevant input fields
        $('[name="discount_percentage"], [name="tax_percentage"], .product_quantity, .product_unitprice').on('input', calculateTotalAmount);



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

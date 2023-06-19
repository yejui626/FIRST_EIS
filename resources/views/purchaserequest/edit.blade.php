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
                        <h4>Edit Purchase Request</h4>
                    </div>
                    <div class="card-body ">
                        <form method="POST" id="pr-form" action="{{ route('purchaserequest.update', $purchaserequest->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ $purchaserequest->status }}" />
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Purchase Request ID</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="pr_id" id="pr_id" placeholder="pr_id" value="{{ $purchaserequest->id }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Requested By</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="requestor" id="requestor" placeholder="Requestor Name" value="{{ $purchaserequest->requestor }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Supplier</label>
                                <div class="col-md-5">
                                    <select name="supplier_id" id="supplier" class="custom-select custom-select-sm rounded-0 select2" aria-label="Default select example">
                                    <option selected disabled>Choose Supplier</option>
                                    @foreach($suppliers as $row)
                                        <option value="{{ $row->id }}" @if($row->id == $purchaserequest->supplier_id) selected @endif>{{$row->supplier_name}}</option>
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
                                                <th class="px-1 py-1 text-center">Item Code | Part Number</th>
                                                <th class="px-1 py-1 text-center">Delivery Date</th>
                                                <th class="px-1 py-1 text-center">Qty</th>
                                                <th class="px-1 py-1 text-center">UOM</th>
                                                <th class="px-1 py-1 text-center">Price/Unit (MYR)</th>
                                                <th class="px-1 py-1 text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchaserequest_items as $index => $item)
                                            <tr class="pr-item" data-id="{{ $index }}">
                                                <td class="align-middle p-1 text-center"></td>
                                                <td class="align-middle p-0 text-center">
                                                    {{ $index + 1 }}
                                                </td>
                                                <td class="align-middle p-1">
                                                    <select name="product_id[]" class="custom-select custom-select-sm rounded-0 select2 product-select" aria-label="Default select example">
                                                        <option selected disabled>Choose Product</option>
                                                        @foreach($products as $row)
                                                            <option value="{{$row->id}}" @if($row->id == $item->product_id) selected @endif>{{$row->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="date" class="form-control form-control-sm rounded-0" name="delivery_date[]" value="{{ $item->delivery_date }}">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="number" class="form-control form-control-sm rounded-0 product_quantity" name="quantity[]" min="1" value="{{ $item->product_quantity }}">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="text" name="uom[]" class="form-control form-control-sm rounded-0" value="{{ $item->uom }}">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="number" class="form-control form-control-sm rounded-0 text-right product_unitprice" name="price[]" min="0" value="{{ $item->product_unitprice }}">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="text" class="form-control form-control-sm rounded-0 text-right total" name="total[]" readonly>
                                                </td>
                                                <td class="align-middle p-1">
                                                    <button type="button" class="remove-table-row btn btn-sm btn-danger">X</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-lightblue">
                                                <th class="p-1 text-right" colspan="7">Sub Total</th>
                                                <th class="p-1 text-right" id="subtotal">0</th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="7">Discount (%)
                                                    <input type="number" step="any" name="discount_percentage" class="text-right" value="{{ $purchaserequest->discount_percentage }}">
                                                </th>
                                                <th class="p-1"><input type="text" class="form-control form-control-sm rounded-0 text-right discount_amount" name="discount_amount" readonly></th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="7">Tax Inclusive (%)
                                                    <input type="number" name="tax_percentage" class="text-right" value="{{ $purchaserequest->tax_percentage }}">
                                                </th>
                                                <th class="p-1">
                                                    <input type="text" class="form-control form-control-sm rounded-0 text-right tax_amount" name="tax_amount" readonly>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="7">Total</th>
                                                <th class="p-1 text-right" id="total_amount">0</th>
                                            </tr>
                                            <input type="hidden" name="total_amount" id="total_amount_input">
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <label for="notes" class="control-label">Notes</label>
                                        <textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0">{{ $purchaserequest->notes }}</textarea>

                                    </div>
                            
                    </div>
                    <div class="text-center">
                                <button class="btn btn-flat btn-primary" form="pr-form">Save</button>
                                <a class="btn btn-flat btn-default" href="{{ route('purchaserequest.index') }}">Cancel</a>
                            </div>
                        </form>
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
        var rowCounter = {{ $rowCount }};

        // Add item to the table
        function addItem() {
            var newRow = `
                <tr class="pr-item" data-id="${rowCounter}">
            <td class="align-middle p-1 text-center"></td>
            <td class="align-middle p-0 text-center">${rowCounter}</td>
            <td class="align-middle p-1">
                <select name="product_id[]" class="custom-select custom-select-sm rounded-0 select2 product-select" aria-label="Default select example">
                    <option disabled selected>Choose Product</option>
                    @foreach($products as $row)
                        <option value="{{$row->id}}">{{$row->product_name}}</option>
                    @endforeach
                </select>
            </td>
            <td class="align-middle p-1">
                <input type="date" class="form-control form-control-sm rounded-0" name="delivery_date[]">
            </td>
            <td class="align-middle p-1">
                <input type="number" class="form-control form-control-sm rounded-0 product_quantity" name="quantity[]" min="1">
            </td>
            <td class="align-middle p-1">
                <input type="text" name="uom[]" class="form-control">
            </td>
            <td class="align-middle p-1">
                <input type="number" class="form-control form-control-sm rounded-0 product_unitprice" name="price[]" min="0">
            </td>
            <td class="align-middle p-1">
                <input type="text" class="form-control form-control-sm rounded-0 total_price" name="total[]" readonly>
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
            var rowTotal = quantity * unitPrice;
            row.find('.total').val(rowTotal.toFixed(2));
        }

        // Calculate subtotal, discount amount, tax amount, and total amount
        function calculateTotalAmount() {
            var subtotal = 0;
            var discountPercentage = parseFloat($('[name="discount_percentage"]').val()) || 0;
            var taxPercentage = parseFloat($('[name="tax_percentage"]').val()) || 0;

            $('.pr-item').each(function() {
                var rowTotal = parseFloat($(this).find('.total').val()) || 0;
                subtotal += rowTotal;
            });

            var discountAmount = (subtotal * (discountPercentage / 100)).toFixed(2);
            var taxAmount = (subtotal * (taxPercentage / 100)).toFixed(2);
            var totalAmount = subtotal - parseFloat(discountAmount) + parseFloat(taxAmount);

            $('[name="discount_amount"]').val(discountAmount);
            $('[name="tax_amount"]').val(taxAmount);
            $('#subtotal').text(subtotal.toFixed(2));
            $('#total_amount').text(totalAmount.toFixed(2));
            $('#total_amount_input').val(totalAmount.toFixed(2));
        }

        // Add an event listener to relevant input fields
        $('[name="discount_percentage"], [name="tax_percentage"], .product_quantity, .product_unitprice').on('input', function() {
            calculateRowTotal($(this).closest('.pr-item'));
            calculateTotalAmount();
        });

        // Remove a row from the table
        function removeRow(row) {
            row.remove();
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

            // Trigger calculation and display functions
            calculateRowTotal($('.pr-item'));
            calculateTotalAmount();


    });
</script>

@endsection

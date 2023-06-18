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
                        <form method="POST" action="{{ route('purchaseRequest.update', $purchaserequest->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Purchase Request ID</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="pr_id" id="pr_id" placeholder="pr_id" value="{{ $purchaserequest->id }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Supplier</label>
                                <div class="col-md-5">
                                    <select name="selectSupplier" id="selectSupplier" class="custom-select custom-select-sm rounded-0 select2" aria-label="Default select example">
                                        <option selected disabled>Choose Supplier</option>
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
                                                    <input type="number" class="form-control form-control-sm rounded-0 qty" name="quantity[]" min="1" value="{{ $item->quantity }}">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <select name="uom[]" class="custom-select custom-select-sm rounded-0 select2">
                                                        <option selected disabled>Choose UOM</option>
                                                        <option value="unit" @if($item->uom == 'unit') selected @endif>unit</option>
                                                        <option value="EA" @if($item->uom == 'EA') selected @endif>EA</option>
                                                        <option value="bag" @if($item->uom == 'bag') selected @endif>bag</option>
                                                        <option value="BKT" @if($item->uom == 'BKT') selected @endif>BKT</option>
                                                        <option value="BND" @if($item->uom == 'BND') selected @endif>BND</option>
                                                        <option value="BX" @if($item->uom == 'BX') selected @endif>BX</option>
                                                        <option value="CM" @if($item->uom == 'CM') selected @endif>CM</option>
                                                        <option value="CTN" @if($item->uom == 'CTN') selected @endif>CTN</option>
                                                    </select>
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="number" class="form-control form-control-sm rounded-0 unitprice" name="price[]" min="0" value="{{ $item->price }}">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <input type="text" class="form-control form-control-sm rounded-0 total" name="total[]" readonly value="{{ $item->total }}">
                                                </td>
                                                <td class="align-middle p-1">
                                                    <button type="button" class="remove-table-row btn btn-sm btn-danger">X</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right">
                                <h5>Grand Total (MYR): <span id="grand_total">{{ $purchaserequest->grand_total }}</span></h5>
                                <input type="hidden" name="grand_total" id="grand_total_input" value="{{ $purchaserequest->grand_total }}">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
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
        var rowCounter = {{ $rowCount }};

        // Add item to the table
        function addItem() {
            var newRow = `
                <tr class="pr-item" data-id="${rowCounter}">
                    <td class="align-middle p-1 text-center"></td>
                    <td class="align-middle p-0 text-center">${rowCounter}</td>
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
                        <input type="number" class="form-control form-control-sm rounded-0 qty" name="quantity[]" min="1" value="{{ $item->quantity }}">
                    </td>
                    <td class="align-middle p-1">
                        <select name="uom[]" class="custom-select custom-select-sm rounded-0 select2">
                            <option selected disabled>Choose UOM</option>
                            <option value="unit" @if($item->uom == 'unit') selected @endif>unit</option>
                            <option value="EA" @if($item->uom == 'EA') selected @endif>EA</option>
                            <option value="bag" @if($item->uom == 'bag') selected @endif>bag</option>
                            <option value="BKT" @if($item->uom == 'BKT') selected @endif>BKT</option>
                            <option value="BND" @if($item->uom == 'BND') selected @endif>BND</option>
                            <option value="BX" @if($item->uom == 'BX') selected @endif>BX</option>
                            <option value="CM" @if($item->uom == 'CM') selected @endif>CM</option>
                            <option value="CTN" @if($item->uom == 'CTN') selected @endif>CTN</option>
                        </select>
                    </td>
                    <td class="align-middle p-1">
                        <input type="number" class="form-control form-control-sm rounded-0 unitprice" name="price[]" min="0" value="{{ $item->price }}">
                    </td>
                    <td class="align-middle p-1">
                        <input type="text" class="form-control form-control-sm rounded-0 total" name="total[]" readonly value="{{ $item->total }}">
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
            var quantity = parseInt(row.find('.qty').val()) || 0;
            var unitPrice = parseFloat(row.find('.unitprice').val()) || 0;
            var total = quantity * unitPrice;
            row.find('.total').val(total.toFixed(2));
        }

        // Calculate grand total
        function calculateGrandTotal() {
            var grandTotal = 0;
            $('.pr-item').each(function() {
                var rowTotal = parseFloat($(this).find('.total').val()) || 0;
                grandTotal += rowTotal;
            });
            $('#grand_total').text(grandTotal.toFixed(2));
            $('#grand_total_input').val(grandTotal.toFixed(2));
        }

        // Event listener for adding item
        $('.add-item').click(function() {
            addItem();
        });

        // Event listener for removing item
        $('#table').on('click', '.remove-table-row', function() {
            $(this).closest('tr').remove();
            updateRowNumbers();
            calculateGrandTotal();
        });

        // Event listener for calculating row total when quantity or unit price changes
        $('#table').on('change', '.qty, .unitprice', function() {
            var row = $(this).closest('tr');
            calculateRowTotal(row);
            calculateGrandTotal();
        });

        // Initial calculation for existing rows
        $('.pr-item').each(function() {
            calculateRowTotal($(this));
        });
        calculateGrandTotal();
    });
</script>
@endsection

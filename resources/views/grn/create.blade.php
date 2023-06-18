@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'grn'
])

@section('content')
    <div class="content d-flex justify-content-center align-items-center">
        <div class="card bg-white p-4 col-md-8">
            <div class="card-header">
                <h4 class="card-title">Add New GRN</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('grn.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="grn_number">GRN Number</label>
                        <input type="text" name="grn_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="purchase_order_no">Purchase Order Number</label>
                        <input type="text" name="purchase_order_no" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" class="form-control" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="received_date">Received Date</label>
                                <input type="date" name="received_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="custdelivery_date">Customer Delivery Date</label>
                                <input type="date" name="custdelivery_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_grn">To</label>
                                <input type="text" name="to_grn" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient_grn">Recipient</label>
                                <input type="text" name="recipient_grn" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="grn-rows-container">
                        <div class="grn-row">
                            <div class="form-row align-items-center">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="item[]">Item</label>
                                        <input type="text" name="item[]" class="form-control item-number" value="1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_received[]">Product Name</label>
                                        <input type="text" name="product_received[]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="qty[]">Quantity</label>
                                        <input type="number" name="qty[]" class="form-control quantity-input" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="product_uom[]">Product UOM</label>
                                        <input type="text" name="product_uom[]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="description[]">Description</label>
                                        <textarea name="description[]" class="form-control form-control-height"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger remove-row-btn" title="Remove Row">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-primary add-row-btn">Add Row</button>
                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="total_quantity">Total Quantity</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="total_quantity" class="form-control total-quantity" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addRowButton = document.querySelector('.add-row-btn');
            var grnRowsContainer = document.querySelector('.grn-rows-container');
            var totalQuantityInput = document.querySelector('.total-quantity');

            addRowButton.addEventListener('click', function() {
                var grnRow = document.createElement('div');
                grnRow.className = 'grn-row';

                var rowHtml = `
                    <div class="form-row align-items-center">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="item[]">Item</label>
                                <input type="text" name="item[]" class="form-control item-number" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_received[]">Product Name</label>
                                <input type="text" name="product_received[]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="qty[]">Quantity</label>
                                <input type="number" name="qty[]" class="form-control quantity-input" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="product_uom[]">Product UOM</label>
                                <input type="text" name="product_uom[]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description[]">Description</label>
                                <textarea name="description[]" class="form-control form-control-height"></textarea>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group d-flex justify-content-center">
                                <button type="button" class="btn btn-danger remove-row-btn" title="Remove Row">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                grnRow.innerHTML = rowHtml;
                grnRowsContainer.appendChild(grnRow);

                // Update item numbers
                var itemNumbers = document.querySelectorAll('.item-number');
                itemNumbers.forEach(function(itemNumber, index) {
                    itemNumber.value = index + 1;
                });

                // Update total quantity
                var quantityInputs = document.querySelectorAll('.quantity-input');
                var totalQuantity = 0;
                quantityInputs.forEach(function(quantityInput) {
                    totalQuantity += parseFloat(quantityInput.value);
                });
                totalQuantityInput.value = totalQuantity;
            });

            grnRowsContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-row-btn')) {
                    var grnRow = event.target.closest('.grn-row');
                    grnRowsContainer.removeChild(grnRow);

                    // Update item numbers
                    var itemNumbers = document.querySelectorAll('.item-number');
                    itemNumbers.forEach(function(itemNumber, index) {
                        itemNumber.value = index + 1;
                    });

                    // Update total quantity
                    var quantityInputs = document.querySelectorAll('.quantity-input');
                    var totalQuantity = 0;
                    quantityInputs.forEach(function(quantityInput) {
                        totalQuantity += parseFloat(quantityInput.value);
                    });
                    totalQuantityInput.value = totalQuantity;
                }
            });
        });
    </script>
@endsection

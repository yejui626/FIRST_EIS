@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'grn'
])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@section('content')
    <div class="content d-flex justify-content-center align-items-center">
        <div class="card bg-white p-4 col-md-8">
            <div class="card-header">
                <h4 class="card-title">Edit GRN: {{ $grn->grn_number }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('grn.update', $grn->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="grn_number" class="col-md-3 col-form-label">GRN Number</label>
                        <div class="col-md-9">
                            <input type="text" name="grn_number" class="form-control" value="{{ $grn->grn_number }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="purchase_order_no" class="col-md-3 col-form-label">Purchase Order Number</label>
                        <div class="col-md-9">
                            <input type="text" name="purchase_order_no" class="form-control" value="{{$purchaseorder->po_no}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supplier_id" class="col-md-3 col-form-label">Supplier</label>
                        <div class="col-md-9">
                        <select name="supplier_id" class="form-control" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @if ($supplier->id == $supplier->id) selected @endif>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="received_date" class="col-md-3 col-form-label">Received Date</label>
                        <div class="col-md-9">
                            <input type="date" name="received_date" class="form-control" value="{{ $grn->received_date }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custdelivery_date" class="col-md-3 col-form-label">Customer Delivery Date</label>
                        <div class="col-md-9">
                            <input type="date" name="custdelivery_date" class="form-control" value="{{ $grn->custdelivery_date }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="to_grn" class="col-md-3 col-form-label">To</label>
                        <div class="col-md-9">
                            <input type="text" name="to_grn" class="form-control" value="{{ $grn->to_grn }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient_grn" class="col-md-3 col-form-label">Recipient</label>
                        <div class="col-md-9">
                            <input type="text" name="recipient_grn" class="form-control" value="{{ $grn->recipient_grn }}" required>
                        </div>
                    </div>

                    <div class="grn-rows-container">
                        @foreach($grn->grnItems as $item)
                            <div class="grn-row">
                                <div class="form-group row">
                                    <label for="item[]" class="col-md-3 col-form-label">Item</label>
                                    <div class="col-md-3">
                                        <input type="text" name="item[]" class="form-control item-number" readonly>
                                    </div>
                                    <label for="product_received[]" class="col-md-3 col-form-label">Product Received</label>
                                    <div class="col-md-3">
                                        <input type="text" name="product_received[]" class="form-control" value="{{ $item->product->product_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="qty[]" class="col-md-3 col-form-label">Quantity</label>
                                    <div class="col-md-3">
                                        <input type="text" name="qty[]" class="form-control quantity-input" value="{{ $item->qty }}">
                                    </div>
                                    <label for="product_uom[]" class="col-md-3 col-form-label">Product UOM</label>
                                    <div class="col-md-3">
                                        <input type="text" name="product_uom[]" class="form-control" value="{{ $item->product_uom }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description[]" class="col-md-3 col-form-label">Description</label>
                                    <div class="col-md-8">
                                        <textarea name="description[]" class="form-control">{{ $item->description }}</textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-link p-0 delete-row-btn">
                                            <i class="fas fa-trash-alt fa-md"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-md-2">
                            <label for="total_qty" class="col-form-label">Total Quantity</label>
                            <input type="text" name="total_qty" class="form-control total-quantity" value="{{ $grn->total_qty }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-6 offset-md-3">
                            <button type="button" class="btn btn-primary add-row-btn">Add Row</button>
                            <button type="submit" class="btn btn-primary ml-2" onclick="confirmEdit()">Save</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>

    $(document).ready(function() {
        updateItemNumbers();
    });

    function confirmEdit() {
        if (confirm("Are you sure you want to edit this GRN?")) {
            document.getElementById("editForm").submit();
        }
    }
    
    // JavaScript code for adding and deleting rows, updating item numbers, and calculating total quantity
    
    // Function to add a new row
    function addRow() {
        var grnRow = `
            <div class="grn-row">
                <div class="form-group row">
                    <label for="item[]" class="col-md-3 col-form-label">Item</label>
                    <div class="col-md-3">
                        <input type="text" name="item[]" class="form-control item-number" readonly>
                    </div>
                    <label for="product_received[]" class="col-md-3 col-form-label">Product Received</label>
                    <div class="col-md-3">
                        <input type="text" name="product_received[]" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="qty[]" class="col-md-3 col-form-label">Quantity</label>
                    <div class="col-md-3">
                        <input type="text" name="qty[]" class="form-control quantity-input">
                    </div>
                    <label for="product_uom[]" class="col-md-3 col-form-label">Product UOM</label>
                    <div class="col-md-3">
                        <input type="text" name="product_uom[]" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description[]" class="col-md-3 col-form-label">Description</label>
                    <div class="col-md-8">
                        <textarea name="description[]" class="form-control"></textarea>
                    </div>
                    <button type="button" class="btn btn-link p-0 delete-row-btn">
                        <i class="fas fa-trash-alt fa-md"></i>
                    </button>
                </div>
            </div>
        `;
        $(".grn-rows-container").append(grnRow);
        updateItemNumbers();
    }
    
    // Function to delete a row
    function deleteRow(button) {
        $(button).closest(".grn-row").remove();
        updateItemNumbers();
    }
    
    // Function to update item numbers
    function updateItemNumbers() {
        var itemNumbers = $(".grn-row").map(function(index) {
            return index + 1;
        }).get();
        $(".item-number").each(function(index) {
            $(this).val(itemNumbers[index]);
        });
    }
    
    // Function to calculate total quantity
    function calculateTotalQuantity() {
        var totalQuantity = 0;
        $(".quantity-input").each(function() {
            var quantity = parseFloat($(this).val());
            if (!isNaN(quantity)) {
                totalQuantity += quantity;
            }
        });
        $(".total-quantity").val(totalQuantity);
    }
    
    // Add Row button click event
    $(".add-row-btn").on("click", function() {
        addRow();
    });
    
    // Delete Row button click event
    $(document).on("click", ".delete-row-btn", function() {
        deleteRow(this);
    });
    
    // Quantity input change event
    $(document).on("input", ".quantity-input", function() {
        calculateTotalQuantity();
    });

    $(document).on("submit", "#editForm", function(event) {
        if (!confirm("Are you sure you want to edit this GRN?")) {
            event.preventDefault();
        }
    });
</script>
@endpush

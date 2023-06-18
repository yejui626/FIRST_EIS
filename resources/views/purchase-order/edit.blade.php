@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchase-order'
])

@section('content')
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* Firefox */
	input[type=number] {
		-moz-appearance: textfield;
	}
	[name="tax_percentage"], [name="discount_percentage"] {
		width: 5vw;
	}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Purchase Order</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('po.update', $purchaseOrder->po_id) }}" method="POST" id="po-form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="supplier_id">Supplier Name</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" id="supplier_name"
                                        value="{{$purchaseOrder->supplier->supplier_name}}" readonly>
                                </div>

                                <input type="hidden" class="form-control form-control-sm rounded-0" id="supplier_id"
                                    name="supplier_id" value="{{$purchaseOrder->supplier_id}}" hidden>
                                    <input type="hidden" class="form-control form-control-sm rounded-0" id="requestor"
                                    name="requestor" value="{{$purchaseOrder->requestor}}" hidden>
                                    <div class="col-md-3 form-group">
                                <label for="po_prno">Buyer Name: <span class="po_err_msg text-danger"></span></label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="buyer"
                                    name="buyer" value="{{$purchaseOrder->buyer}}" >
                            </div>
                                <div class="col-md-3 form-group">
                                    <label for="po_no">PO # <span class="po_err_msg text-danger"></span></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" id="po_no"
                                        name="po_no" value="{{$purchaseOrder->po_no}}" readonly>
                                    <small><i>Leave this blank to Automatically Generate upon saving.</i></small>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="po_prno">PR # <span class="po_err_msg text-danger"></span></label>
                                    <input type="text" class="form-control form-control-sm rounded-0" id="po_prno"
                                        name="po_prno" value="{{$purchaseOrder->po_prno}}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id="item-list">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="30%">
                                        <col width="15%">
                                        <col width="15%">
                                        <col width="15%">
                                    </colgroup>
                                    <thead>
                                        <tr class="bg-navy disabled">
                                            <th class="px-1 py-1 text-center"></th>
                                            <th class="px-1 py-1 text-center">QTY</th>
                                            <th class="px-1 py-1 text-center">UOM</th>
                                            <th class="px-1 py-1 text-center">Item</th>
                                            <th class="px-1 py-1 text-center">Delivery Date</th>
                                            <th class="px-1 py-1 text-center">Price</th>
                                            <th class="px-1 py-1 text-center">Total</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                    @php
                                    $subtotal = 0;
                                    @endphp
                                     @foreach($PurchaseOrder_Items as $orderItem)

                                        <tr class="po-item" data-id="">
                                            <td class="align-middle p-1 text-center">
                                                <button class="btn btn-sm btn-danger py-0" type="button"
                                                    onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                            </td>
                                            <td class="align-middle p-0 text-center">
                                                <input type="number" class="text-center w-100 border-0"
                                                    step="any" name="order_quantity[]" value="{{$orderItem->order_quantity}}"/>
                                            </td>
                                            <td class="align-middle p-1">
                                            <input type="text" class="text-center w-100 border-0"
                                                    step="any" name="order_unit[]" value="{{$orderItem->order_unit}}"/>

                                            </td>

                                            <td class="align-middle p-1">
                                                <input type="text" class="text-center w-100 border-0"
                                                    value="{{$orderItem->product->product_name}}" readonly/>
                                                    <input type="hidden" class="text-center w-100 border-0"
                                                    value="{{$orderItem->order_item_id}}" name="order_item_id[]" readonly/>
                                            </td>
                                            
                                            <td class="align-middle p-1">
                                            <input type="date" class="text-center w-100 border-0"
                                                    value="{{$orderItem->delivery_date}}" name =delivery_date[]/>
        
                                            </td>
                                           
                                          
                                            <td class="align-middle p-1">
                                                <input type="text" step="any"
                                                    class="text-right w-100 border-0" name="order_unitprice[]" value="{{$orderItem->order_unitprice}}"  />
                                            </td>

                                            <td class="align-middle p-1 text-right total-price">0</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-lightblue">
                                            <tr>
                                                <th class="p-1 text-right" colspan="6"><span><button
                                                            class="btn btn btn-sm btn-flat btn-primary py-0 mx-1"
                                                            type="button" id="add_row">Add Row</button></span>
                                                    Sub Total</th>
                                                <th class="p-1 text-right" id="sub_total">{{number_format($subtotal, 2)}}</th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="6">Discount (%)
                                                    <input type="number" step="any" name="discount_percentage"
                                                        class="border-light text-right" value="{{number_format($purchaseOrder->discount_percentage ?? 0, 2)}}">
                                                </th>
                                                <th class="p-1"><input type="text" class="w-100 border-0 text-right"
                                                        readonly value="" name="discount_amount" value=""></th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="6">Tax Inclusive (%)
                                                    <input type="number" step="any" name="tax_percentage"
                                                        class="border-light text-right" value = "{{number_format($purchaseOrder->tax_percentage ?? 0, 2)}}">
                                                </th>
                                                <th class="p-1"><input type="text" class="w-100 border-0 text-right"
                                                         name="tax_amount"></th>
                                            </tr>
                                            <tr>
                                                <th class="p-1 text-right" colspan="6">Total</th>
                                                <th class="p-1 text-right" id="total">0</th>
                                            </tr>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="notes" class="control-label">Notes</label>
                                        <textarea name="notes" id="notes" cols="10" rows="4"
                                            class="form-control rounded-0">{{$purchaseOrder->notes}}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-flat btn-primary" form="po-form">Save</button>
                    <a class="btn btn-flat btn-default" href="{{ url()->previous() }}">Cancel</a>
                </div>
            </div>
            <table class="d-none" id="item-clone">
                <tr class="po-item" data-id="">
                    <td class="align-middle p-1 text-center">
                        <button class="btn btn-sm btn-danger py-0" type="button"
                            onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                    </td>
                    <td class="align-middle p-0 text-center">
                        <input type="number" class="text-center w-100 border-0" step="any" name="order_quantity[]" />
                    </td>
                    <td class="align-middle p-1">
                    <input type="text" class="text-center w-100 border-0"
                     step="any" name="order_unit[]" />
                    </td>
                    <td class="align-middle p-1">

                        <select name="order_item_id[]" class="text-center w-100 border-0"
                            placeholder="Select a Product">
                            <option value="none" selected disabled hidden>Select a Product</option>
                            @foreach($product as $p)
                            <option value="{{ $p->id }}">{{ $p->product_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="align-middle p-1">
                        <input type="date" class="text-center w-100 border-0"
                         name = delivery_date[] />
                    <td class="align-middle p-1">
                        <input type="number" step="any" class="text-right w-100 border-0" name="order_unitprice[]"
                            value="" />
                    </td>
                    <td class="align-middle p-1 text-right total-price">0</td>
                </tr>
            </table>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>



<script>

	function rem_item(_this){
		_this.closest('tr').remove()
	}
	function calculate(){
		var _total = 0
		$('.po-item').each(function(){
			var order_quantity = $(this).find("[name='order_quantity[]']").val()
			var unit_price = $(this).find("[name='order_unitprice[]']").val()
			var row_total = 0;
			if(order_quantity > 0 && unit_price > 0){
				row_total = parseFloat(order_quantity) * parseFloat(unit_price)
			}
			$(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'))
		})
		$('.total-price').each(function(){
			var _price = $(this).text()
				_price = _price.replace(/\,/gi,'')
				_total += parseFloat(_price)
		})
		var discount_perc = 0
		if($('[name="discount_percentage"]').val() > 0){
			discount_perc = $('[name="discount_percentage"]').val()
		}
		var discount_amount = _total * (discount_perc/100);
		discount_amount = discount_amount.toLocaleString('en-US');  // Format discount_amount with commas
        discount_amount = discount_amount.replace(/,/gi, '');  // Remove commas from discount_amount
        $('[name="discount_amount"]').val(discount_amount);
		var tax_perc = 0
		if($('[name="tax_percentage"]').val() > 0){
			tax_perc = $('[name="tax_percentage"]').val()
		}
		var tax_amount = _total * (tax_perc/100);
		tax_amount = tax_amount.toLocaleString('en-US');  // Format discount_amount with commas
        tax_amount = tax_amount.replace(/,/gi, '');  // Remove commas from discount_amount
        $('[name="tax_amount"]').val(tax_amount);
		$('#sub_total').text(parseFloat(_total).toLocaleString("en-US"))
		$('#total').text(parseFloat(_total-discount_amount).toLocaleString("en-US"))
	}
	
    function _autocomplete(_item){
		_item.find('.order_item_id').autocomplete({
			source:function(request, response){
				$.ajax({
					url:_base_url_+"classes/Master.php?f=search_items",
					method:'POST',
					data:{q:request.term},
					dataType:'json',
					error:err=>{
						console.log(err)
					},
					success:function(resp){
						response(resp)
					}
				})
			},
			select:function(event,ui){
				console.log(ui)
				_item.find('input[name="order_item_id[]"]').val(ui.item.id)
				_item.find('.item-description').text(ui.item.description)
			}
		})
	}
	
	$(document).ready(function(){

		
		$('#add_row').click(function(){
			var tr = $('#item-clone tr').clone()
			$('#item-list tbody').append(tr)
			_autocomplete(tr)
			tr.find('[name="order_quantity[]"],[name="order_unitprice[]"]').on('input keypress',function(e){
				calculate()
			})
			$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
				calculate()
			})
		})
		if($('#item-list .po-item').length > 0){
			$('#item-list .po-item').each(function(){
				var tr = $(this)
				_autocomplete(tr)
				tr.find('[name="order_quantity[]"],[name="order_unitprice[]"]').on('input keypress',function(e){
					calculate()
				})
				$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
					calculate()
				})
				tr.find('[name="order_quantity[]"],[name="order_unitprice[]"]').trigger('keypress')
			})
		}else{
		$('#add_row').trigger('click')
		}
        $('.select2').select2({placeholder:"Please Select here",width:"relative"})
		$('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			$('.err-msg').remove();
			$('[name="po_no"]').removeClass('border-danger')
			if($('#item-list .po-item').length <= 0){
				alert_toast(" Please add atleast 1 item on the list.",'warning')
				return false;
			}
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_po",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=purchase_orders/view_po&id="+resp.id;
					}else if((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                            end_loader()
							if(resp.status == 'po_failed'){
								$('[name="po_no"]').addClass('border-danger').focus()
							}
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

        
	})
</script>
    

@endsection


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
		[name="tax_percentage"],[name="discount_percentage"]{
			width:5vw;
		}

        

    
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Purchase Order</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-flat btn-success"  id="print" type="button">
                                <i class="fa fa-print"></i> Print
                            </button>
                            <?php $role = Auth::user()->role; ?>
                                        @if($role == 2)
                            <a class="btn btn-sm btn-flat btn-primary" href="{{ route('po.edit', $purchaseorder->po_id) }}">Edit</a>
                            @endif
                            <a class="btn btn-sm btn-flat btn-default" href="{{ route('po.index')}}">Back</a>
                        </div>
                    </div>
                    <div class="card-body" id="out_print">
                        <div class="row">
                            <div class="col-6">
                            <img src="{{ url('storage/images/logo.png') }}" alt="" width="450px" height="200px">
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="col-6">
                                <h2 ><b>PURCHASE ORDER</b></h2>
                            </div>
                            </div>
                        <div class="row mb-2">
                            <div class="col-6"><div>
                                    <p class="m-0">DELIVERY TO:</p>
                                    <p class="m-0"><b>TSK SYNERGY SDN BHD</b></p>
                                    <p class="m-0">NO. 19, JALAN MEGA 1/8, TAMAN PERINDUSTRIAN NUSA CEMERLANG</p>
                                    <p class="m-0">79200 ISKANDAR PUTERI, JOHOR</p>
                                </div>
                                <br>
                                <p class="m-0">TO:</p>
                                <div>
                                    <p class="m-0"><b>{{strtoupper($supplier->supplier_name)}}</b></p>
                                    <p class="m-0">{{$supplier->supplier_phone}}</p>
                                    <p class="m-0">{{strtoupper($supplier->supplier_address)}}</p>
                                </div>
                            </div>
                            <div class="col-6 row">
                            <div class="col-6 offset-7">  
                                    <p class="m-0"><b>P.R #:</b> {{$purchaseorder->po_prno}}</p>
                                    <p class="m-0"><b>P.O. #:</b> {{$purchaseorder->po_no}}</p>
                                    <p class="m-0"><b>Date Created:</b> {{$purchaseorder->created_at}}</p>
                                    <p class="m-0"><b>Requestor Name:</b> {{$purchaseorder->requestor}}</p>
                                    <p class="m-0"><b>Buyer Name:</b> {{$purchaseorder->buyer}}</p>
                            </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" id="item-list">
                                    <colgroup>
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="20%">
                                        <col width="15%">
                                        <col width="15%">
                                        <col width="15%">
                                        <col width="15%">
                                    </colgroup>
                                    <thead style="border-style: solid; border-color: black; border-width: 2px;">
                                        <tr class="bg-navy disabled" style="">
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="bg-navy px-1 py-1 text-center">Qty</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="bg-navy px-1 py-1 text-center">UOM</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="bg-navy px-1 py-1 text-center">Item</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="bg-navy px-1 py-1 text-center">Category</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="bg-navy px-1 py-1 text-center">Delivery Date</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="bg-navy px-1 py-1 text-center">Price</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="bg-navy px-1 py-1 text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        @endphp
                                        @foreach($orderItems as $orderItem)
                                        <tr style="border-style: solid; border-color: black; border-width: 2px;" class="po-item" data-id="">
                                            @php
                                            $subtotal += ($orderItem->order_quantity) * ($orderItem->order_unitprice)
                                            @endphp
                                            <td style="border-style: solid; border-color: black; border-width: 2px;" class="align-middle p-0 text-center">{{$orderItem->order_quantity}}</td>
                                            <td style="border-style: solid; border-color: black; border-width: 2px;" class="align-middle p-1 text-center">{{$orderItem->order_unit}}</td>
                                            <td style="border-style: solid; border-color: black; border-width: 2px;" class="align-middle p-1">{{$orderItem->product->product_name}}</td>
                                            <td style="border-style: solid; border-color: black; border-width: 2px;" class="align-middle p-1 text-center">{{$orderItem->product->productCategory->category_name}}</td>
                                            <td style="border-style: solid; border-color: black; border-width: 2px;" class="align-middle p-1 text-center">{{$orderItem->delivery_date}}</td>
                                            <td style="border-style: solid; border-color: black; border-width: 2px;" class="align-middle p-1 text-right">{{number_format($orderItem->order_unitprice, 2)}}</td>
                                            <td style="border-style: solid; border-color: black; border-width: 2px;" class="align-middle p-1 text-right total-price">{{number_format(($orderItem->order_quantity) * ($orderItem->order_unitprice), 2)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-lightblue">
                                            <th class="p-1 text-right" colspan="6">Sub Total</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="p-1 text-right" id="sub_total">{{number_format($subtotal, 2)}}</th>
                                        </tr>
                                        <tr>
                                            <th class="p-1 text-right" colspan="6">Discount ({{$purchaseorder->discount_percentage ?? 0}}%)</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="p-1 text-right">{{number_format($purchaseorder->discount_amount ?? 0, 2)}}</th>
                                        </tr>
                                        <tr>
                                            <th class="p-1 text-right" colspan="6">Tax Inclusive ({{$purchaseorder->tax_percentage ?? 0}}%)</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="p-1 text-right">{{number_format($purchaseorder->tax_amount ?? 0, 2)}}</th>
                                        </tr>
                                        <tr>
                                            <th class="p-1 text-right" colspan="6">Total</th>
                                            <th style="border-style: solid; border-color: black; border-width: 2px;" class="p-1 text-right" id="total">{{number_format(($subtotal - $purchaseorder->discount_amount), 2)}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="notes" class="control-label">Notes</label>
                                        
                                        <p>{{$purchaseorder->notes ?? ''}}</p>
                                    </div>
                                </div>
                                <style>
    div.lower-spacing p {
        margin-bottom: 0.5em; /* Adjust the value to decrease the spacing */
    }
</style>
                                <div class="lower-spacing">
    <b><p>REMARK (Terms & Conditions):</p>
    <p>1. Kindly acknowledge receipt and acceptance of this PO</p>
    <p>2. Please indicate our PO number on your Delivery Order and Invoice</p>
    <p>3. Goods are strictly to be delivered to Receiving Store and delivery document must be acknowledged as proof of delivery.</p>
    <p>4. Provide Certificate of Conformance "COC" or Material Millcert where applicable upon goods delivery.</p>
    <p>5. Notify 365 days in advance of any obsolescence part or material.</p></b>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                    

<table class="d-none" id="item-clone">
	<tr class="po-item" data-id="">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center">
			<input type="number" class="text-center w-100 border-0" step="any" name="order_quantity[]"/>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0" name="order_unit[]"/>
		</td>
		<td class="align-middle p-1">
        <input type="hidden" name="order_item_id[]">
			<input type="text" class="text-center w-100 border-0 order_item_id" required/>
		</td>
		<td class="align-middle p-1 item-description"></td>
		<td class="align-middle p-1">
			<input type="number" step="any" class="text-right w-100 border-0" name="order_unitprice[]" value="0"/>
		</td>
		<td class="align-middle p-1 text-right total-price">0</td>
	</tr>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<script>
	
    
    function start_loader(){
	$('body').prepend('<div id="preloader"></div>')
}
function end_loader(){
	 $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
}
    
  $(function(){
        $('#print').click(function(e){
            e.preventDefault();
            start_loader();
            var _h = $('head').clone()
            var _p = $('#out_print').clone()
            var _el = $('<div>')
                _p.find('thead th')
                _el.append(_h)
                _el.append(_p)
                
            var nw = window.open("","","width=1200,height=950")
                nw.document.write(_el.html())
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        end_loader();
                        nw.close()
                    }, 300);
                }, 200);
        })
    })
    
</script>

@endsection
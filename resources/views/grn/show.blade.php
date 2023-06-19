@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'grn'
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

table {
    border-collapse: collapse;
    border: 4px solid black;
}



    
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Goods Received Note: {{ $grn->grn_number }}</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-flat btn-success"  id="print" type="button">
                                <i class="fa fa-print"></i> Print
                            </button>
                            <a class="btn btn-sm btn-flat btn-primary" href="">Edit</a>
                            <a class="btn btn-sm btn-flat btn-default" href="">Back</a>
                        </div>
                    </div>
                    <div class="card-body" id="out_print">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <div>
                                    <p class="m-0">DELIVERY TO:</p>
                                    <p class="m-0"><b>TSK SYNERGY SDN BHD</b></p>
                                    <p class="m-0">NO. 19, JALAN MEGA 1/8, TAMAN PERINDUSTRIAN NUSA CEMERLANG</p>
                                    <p class="m-0">79200 ISKANDAR PUTERI, JOHOR</p>
                                </div> 
                            </div>
                            <div class="col-6">
                                <center><img src="{{ url('storage/images/logo.png') }}" alt="" width="500px" height="200px"></center>
                                <h2 class="text-center"><b>Goods Received Note</b></h2>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="m-0">TO:</p>
                                <div>
                                    <p class="m-0"><b>{{strtoupper($grn->to_grn)}}</b></p>
                                </div>
                            </div>
                            <div class="col-6 row">
                                <div class="col-6">
                                    <p class="m-0"><b>P.O. #:</b></p>
                                    <p><b>{{$grn->purchase_order_no}}</b></p>
                                </div>
                                <div class="col-6">
                                    <p class="m-0"><b>Date Created</b></p>
                                    <p><b>{{$grn->created_at}}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" id="item-list">
                                    <colgroup>
                                        <col width="10%">
                                        <col width="40%">
                                        <col width="20%">
                                        <col width="15%">
                                        <col width="15%">
                                    </colgroup>
                                    <thead>
                                        <tr class="bg-navy disabled" style="">
                                            <th class="bg-navy px-1 py-1 text-center">Index</th>
                                            <th class="bg-navy px-1 py-1 text-center">ITEM CODE | PART NUMBER</th>
                                            <th class="bg-navy px-1 py-1 text-center">Description</th>
                                            <th class="bg-navy px-1 py-1 text-center">UOM</th>
                                            <th class="bg-navy px-1 py-1 text-center">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($grnItems)
                                        @foreach($grnItems as $index => $grn_item)
                                            <tr class="po-item" data-id="">
                                                <td class="align-middle p-0 text-center">{{$index + 1}}</td>
                                                <td class="align-middle p-1 text-center">{{$grn_item->product->product_name}}</td>
                                                <td class="align-middle p-1">{{$grn_item->description}}</td>
                                                <td class="align-middle p-1 text-right">{{$grn_item->product_uom}}</td>
                                                <td class="align-middle p-1 text-right total-price">{{$grn_item->qty}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-lightblue">
                                            <th class="p-1 text-right" colspan="4">Total Quantity:</th>
                                            <th class="p-1 text-right" id="sub_total">{{$grn->total_qty}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="notes" class="control-label">Notes</label>
                                        <p></p>
                                    </div>
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
                _p.find('thead th').attr('style','color:black !important')
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
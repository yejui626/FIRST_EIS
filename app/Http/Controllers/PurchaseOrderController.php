<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequest_Items;
use App\Models\OrderItems;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $purchaseorder= PurchaseOrder::with('supplier')->orderBy('po_id', 'ASC') ->get();
        return view ('purchase-order.index', compact('purchaseorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $purchaserequest = PurchaseRequest::findOrFail($id);
        $product = Product::orderBy('id', 'ASC') ->get();
        $supplier = $purchaserequest->supplier;
        $orderitems = OrderItems::orderBy('order_po_id', 'ASC') ->get();
        $purchaseorder= PurchaseOrder::orderBy('po_id', 'ASC') ->get();
        $PurchaseRequest_Items = $purchaserequest->items;
        $subtotal = 0;
        return view ('purchase-order.create', compact('product','supplier','orderitems','purchaseorder', 'purchaserequest', 'PurchaseRequest_Items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validate and store the purchase order data
    
    $purchaseOrder = new PurchaseOrder();
    $purchaseOrder->supplier_id = $request->input('supplier_id');
    $purchaseOrder->status = "Ordered";

    // Generate random string for po_no if it is blank
    $poNo = $request->input('po_no');
    if (empty($poNo)) {
        
        $currentDate = date('Ymd'); // Get current date in YYYYMMDD format
        $randomString = strtoupper(Str::random(10));
        $poNo = "PO-$currentDate$randomString"; // Combine the elements to form the purchase order number
    }
    $purchaseOrder->po_no = $poNo;
    $purchaseOrder->po_prno = $request->input('po_prno');
    $purchaseOrder->requestor = $request->input('requestor');
    $purchaseOrder->buyer = $request->input('buyer');
    $purchaseOrder->discount_percentage = $request->input('discount_percentage');
    $purchaseOrder->tax_percentage = $request->input('tax_percentage');
    $purchaseOrder->discount_amount = $request->input('discount_amount');
    $purchaseOrder->tax_amount = $request->input('tax_amount');
    $purchaseOrder->notes = $request->input('notes');
    $purchaseOrder->save();


    // Set other properties of the purchase order

    // Retrieve the newly created purchase order ID
    $po_id = $purchaseOrder->po_id;

    // Loop through the order items and create a new record for each item
    for ($i = 0; $i < count($request->input('order_quantity')); $i++) {
        $orderItem = new OrderItems();
        $orderItem->order_po_id = $po_id;
        $orderItem->order_quantity = $request->input('order_quantity')[$i];
        $orderItem->order_unit = $request->input('order_unit')[$i];
        $orderItem->order_item_id = $request->input('order_item_id')[$i];
        $orderItem->delivery_date = $request->input('delivery_date')[$i];
        $orderItem->order_unitprice = $request->input('order_unitprice')[$i];
        $orderItem->save();
    }

    return redirect()->route('po.index')->with('success', 'Purchase order created successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseorder = PurchaseOrder::findOrFail($id);
        $supplier = $purchaseorder->supplier;
        $orderItems = $purchaseorder->OrderItems;
        $subtotal = 0;
        return view ('purchase-order.show', compact('purchaseorder','supplier','orderItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $product = Product::orderBy('id', 'ASC') ->get();
        $purchaseOrder = PurchaseOrder::find($id);
        $supplier = $purchaseOrder->supplier;
        $PurchaseOrder_Items = $purchaseOrder->OrderItems;
        $subtotal = 0;
        // Retrieve the purchase order record by its ID and pass it to the view for editing
        return view('purchase-order.edit', compact('purchaseOrder', 'supplier', 'purchaseRequest', 'PurchaseOrder_Items', 'product'));
    }

    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validate and update the purchase order data

    
    $purchaseOrder = PurchaseOrder::find($id);

    $purchaseOrder->supplier_id = $request->input('supplier_id');
    $purchaseOrder->status = "Ordered";
    $purchaseOrder->po_no = $request->input('po_no');
    $purchaseOrder->po_prno = $request->input('po_prno');
    $purchaseOrder->requestor = $request->input('requestor');
    $purchaseOrder->buyer = $request->input('buyer');
    $purchaseOrder->discount_percentage = $request->input('discount_percentage');
    $purchaseOrder->tax_percentage = $request->input('tax_percentage');
    $purchaseOrder->discount_amount = $request->input('discount_amount');
    $purchaseOrder->tax_amount = $request->input('tax_amount');
    $purchaseOrder->notes = $request->input('notes');
    $purchaseOrder->save();

    // Update other properties of the purchase order
    
    // Retrieve the purchase order ID
    $po_id = $purchaseOrder->po_id;

    // Delete existing order items related to the purchase order
    OrderItems::where('order_po_id', $po_id)->delete();

    // Loop through the updated order items and create a new record for each item
    for ($i = 0; $i < count($request->input('order_quantity')); $i++) {
        $orderItem = new OrderItems();
        $orderItem->order_po_id = $po_id;
        $orderItem->order_quantity = $request->input('order_quantity')[$i];
        $orderItem->order_unit = $request->input('order_unit')[$i];
        $orderItem->order_item_id = $request->input('order_item_id')[$i];
        $orderItem->delivery_date = $request->input('delivery_date')[$i];
        $orderItem->order_unitprice = $request->input('order_unitprice')[$i];
        $orderItem->save();
    }

    return redirect()->route('po.index')->with('success', 'Purchase order updated successfully.');
}

public function updateStatus(Request $request, $id)
{
    
    $purchaseOrder = PurchaseOrder::findOrFail($id);
    
    $validatedData = $request->validate([
        'status' => 'required|in:Ordered,Closed',
    ]);

    $purchaseOrder->status = $validatedData['status'];
    $purchaseOrder->save();

    return redirect()->route('po.index')->with('success', 'Status updated successfully');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchaseorder = PurchaseOrder::findOrFail($id);

        $purchaseorder->delete();

        return redirect()->route ('po.index')->with('success', 'Product deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequest_Items;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaserequest = PurchaseRequest::all();
        $request_items = PurchaseRequest_Items::all();
        return view('purchaserequest.index', compact('purchaserequest', 'request_items'));
        
    }


    public function purchaserequestpurchase()
    {
        $purchaserequest = PurchaseRequest::all();
        $request_items = PurchaseRequest_Items::all();
        return view('purchase-request-purchase.index', compact('purchaserequest', 'request_items'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $product = Product::all();
        $randomString =  strtoupper(Str::random(5)); 
        $currentDate = date('Ymd');
        $id = "PR-$currentDate$randomString";
        return view('purchaserequest.create', ['supplier' => $supplier, 'id' => $id, 'product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
        // Validate the input data
        $validatedData = $request->validate([
            'id' => 'required',
            'supplier' => 'required',
            'requestor' => 'required',
            'total_amount' => 'required',
        ]);

        // Create a new PurchaseRequest instance
        $purchaserequest = new PurchaseRequest();
        $purchaserequest->id = $validatedData['id'];
        $purchaserequest->status = 'Pending';
        $purchaserequest->requestor = $request->input('requestor');
        $purchaserequest->supplier_id = $validatedData['supplier'];
        $purchaserequest->discount_percentage = $request->input('discount_percentage');
        $purchaserequest->discount_amount = $request->input('discount_amount');
        $purchaserequest->tax_percentage = $request->input('tax_percentage');
        $purchaserequest->tax_amount = $request->input('tax_amount');
        $purchaserequest->total_amount = $request->input('total_amount');
        $purchaserequest->notes = $request->input('notes');
        $purchaserequest->save();

        // Save the purchase request items
        foreach ($request->input('product_id') as $index => $productId) {
            $item = new PurchaseRequest_Items();
            $item->pr_id = $validatedData['id'];
            $item->product_id = $productId;
            $item->delivery_date = $request->input('delivery_date')[$index];
            $item->product_quantity = $request->input('product_quantity')[$index];
            $item->uom = $request->input('uom')[$index];
            $item->product_unitprice = $request->input('product_unitprice')[$index];
            $item->save();
        }
        // Redirect or return a response
        return redirect()->route('purchaserequest.index')->with('success', 'Purchase request created successfully.');
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{   
    $purchaserequest = PurchaseRequest::where('id', $id)->firstOrFail();
    $supplier = $purchaserequest->supplier()->first(); // Retrieve the associated supplier
    $request_items = $purchaserequest->items;

    return view('purchaserequest.show', compact('purchaserequest', 'supplier', 'request_items'));
}




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $purchaserequest = PurchaseRequest::with('supplier')->findOrFail($id);
    $suppliers = Supplier::all();
    $purchaserequest_items = $purchaserequest->items;
    $products = Product::all(); // Retrieve all available products

    foreach ($purchaserequest_items as $item) {
        $products[] = $item->product;
    }

    $rowCount = count($purchaserequest_items);

    return view('purchaserequest.edit', compact('purchaserequest', 'suppliers', 'purchaserequest_items', 'products', 'rowCount'));
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
        dd($request->all());
        $purchaserequest = PurchaseRequest::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $purchaserequest->requestor = $request->input('requestor');
        $purchaserequest->supplier_id = $request->input('supplier_id');
        $purchaserequest->notes = $request->input('notes');
        $purchaserequest->discount_percentage = $request->input('discount_percentage');
        $purchaserequest->tax_percentage = $request->input('tax_percentage');
        
        // Update the purchase request's status
        $purchaserequest->status = $validatedData['status'];

        // Save the changes to the purchase request
        $purchaserequest->save();

        // Redirect back to the index page with a success message
        return redirect()->route('purchaserequest.index')->with('success', 'Purchase request updated successfully');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchaserequest = PurchaseRequest::findOrFail($id);
        $purchaserequest->items()->delete();
        $purchaserequest->delete();
        

        // You can also delete related records if necessary
        // $purchaserequest->items()->delete();

        return redirect()->route('purchaserequest.index')->with('success', 'Purchase Request deleted successfully');
        
    }
}

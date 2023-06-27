<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\GRN;
use App\Models\GRNItem;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Str;
use PDF;


class GRNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $grn = GRN::with('purchaseorder')->orderBy('created_at', 'ASC')->get();
        $suppliers = Supplier::all();
     
        return view('grn.index', compact('grn','suppliers'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($po_id)
    {
        $purchaseorder = PurchaseOrder::findOrFail($po_id);
        $suppliers = Supplier::all();
        $product = Product::all();
        return view('grn.create', compact('purchaseorder', 'suppliers', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'po_id' => 'required',
            'supplier_id' => 'required',
            'received_date' => 'required|date',
            'custdelivery_date' => 'required|date',
            'to_grn' => 'required',
            'recipient_grn' => 'required',
            'product_id' => 'required|array',
            'qty' => 'required|array',
            'product_uom' => 'required|array',
            'description' => 'required|array',
        ]);

        $currentDate = date('Ymd'); // Get current date in YYYYMMDD format
        $randomString = strtoupper(Str::random(10));
        $grnNo = "GRN-$currentDate$randomString"; // Combine the elements to form the purchase order number
        
        $grn = new GRN;
        $grn->grn_number = $grnNo;
        $grn->po_id = $validatedData['po_id'];
        $grn->supplier_id = $validatedData['supplier_id'];
        $grn->received_date = $validatedData['received_date'];
        $grn->custdelivery_date = $validatedData['custdelivery_date'];
        $grn->to_grn = $validatedData['to_grn'];
        $grn->recipient_grn = $validatedData['recipient_grn'];
        $grn->total_qty = array_sum($validatedData['qty']); // Calculate total quantity
        $grn->save();

        // Store the product details in the GRNItem table
        $product_id = $validatedData['product_id'];
        $qty = $validatedData['qty'];
        $product_uom = $validatedData['product_uom'];
        $description = $validatedData['description'];

        for ($i = 0; $i < count($product_id); $i++) {
            $grnItem = new GRNItem;
            $grnItem->product_id = $product_id[$i];
            $grnItem->qty = $qty[$i];
            $grnItem->product_uom = $product_uom[$i];
            $grnItem->description = $description[$i];
            $grnItem->grn_id = $grn->id; // Assign the foreign key
            $grnItem->save();
        }
        foreach ($validatedData['product_id'] as $index => $product_id) {
            $qty = $validatedData['qty'][$index];
            $product = Product::where('product_name', $product_id)->first();
        
            if ($product) {
                $product->product_quantity += $qty;
                $product->save();
            }
        }

        // Redirect with success message
        return redirect()->route('grn.index')->with('success', 'GRN added successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'grn_number' => 'required',
            'po_id' => 'required',
            'supplier_id' => 'required',
            'received_date' => 'required|date',
            'custdelivery_date' => 'required|date',
            'to_grn' => 'required',
            'recipient_grn' => 'required',
            'product_id' => 'required|array',
            'qty' => 'required|array',
            'product_uom' => 'required|array',
            'description' => 'required|array',
        ]);
    
        // Find the GRN record by ID
        $grn = GRN::findOrFail($id);
    
        // Update the GRN attributes
        $grn->grn_number = $validatedData['grn_number'];
        $grn->po_id = $validatedData['po_id'];
        $grn->supplier_id = $validatedData['supplier_id'];
        $grn->received_date = $validatedData['received_date'];
        $grn->custdelivery_date = $validatedData['custdelivery_date'];
        $grn->to_grn = $validatedData['to_grn'];
        $grn->recipient_grn = $validatedData['recipient_grn'];
        $grn->total_qty = array_sum($validatedData['qty']); // Calculate total quantity
        $grn->save();
    
   

        // Update existing GRNItem records
        $product_id = $validatedData['product_id'];
        $qty = $validatedData['qty'];
        $product_uom = $validatedData['product_uom'];
        $description = $validatedData['description'];
    
        foreach ($grn->grnItems as $index => $grnItem) {
            $grnItem->product_id = $product_id[$index];
            $grnItem->qty = $qty[$index];
            $grnItem->product_uom = $product_uom[$index];
            $grnItem->description = $description[$index];
            $grnItem->save();
        }
    
        // Create new GRNItem records for added rows
        $newProductReceived = $validatedData['product_id'];
        $newQty = $validatedData['qty'];
        $newProductUom = $validatedData['product_uom'];
        $newDescription = $validatedData['description'];
    
        for ($i = count($grn->grnItems); $i < count($newProductReceived); $i++) {
            $grnItem = new GRNItem;
            $grnItem->product_id = $newProductReceived[$i];
            $grnItem->qty = $newQty[$i];
            $grnItem->product_uom = $newProductUom[$i];
            $grnItem->description = $newDescription[$i];
            $grnItem->grn_id = $grn->id;
            $grnItem->save();
        }

        foreach ($validatedData['product_id'] as $index => $product_id) {
            $qty = $validatedData['qty'][$index];
            $product = Product::where('product_name', $product_id)->first();
        
            if ($product) {
                $product->product_quantity += $qty;
                $product->save();
            }
      
        // Redirect with success message
        return redirect()->route('grn.index')->with('success', 'GRN updated successfully.');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $grn = GRN::findOrFail($id);
        $supplier = $grn->supplier;
        $grnItems = $grn->grnItems;
        $purchaseorder = PurchaseOrder::find($grn->po_id);

        return view('grn.show', compact('grn', 'supplier', 'grnItems', 'purchaseorder'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $grn = GRN::with('grnItems')->find($id);
        $product = Product::all();
        // Retrieve the related PurchaseOrder model
        $purchaseorder = PurchaseOrder::find($grn->po_id);

        if (!$grn) {
            return redirect()->back()->with('error', 'GRN not found.');
        }
        // Retrieve the selected supplier from the database based on the ID
        $supplier = Supplier::find($grn->supplier_id);

        // Retrieve all the suppliers for the dropdown list
        $suppliers = Supplier::all();
        return view('grn.edit', compact('grn','supplier', 'suppliers', 'product', 'purchaseorder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grn = GRN::findOrFail($id);

        // Delete the associated grn_items records
        $grn->grnItems()->delete();
    
        // Delete the GRN record
        $grn->delete();
    
        return redirect()->route('grn.index')->with('success', 'GRN and associated records deleted successfully');
    }
}

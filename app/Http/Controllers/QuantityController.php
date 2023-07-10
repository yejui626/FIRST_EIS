<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quantity;
use App\Models\Product;
use App\Models\Order;
use App\Models\GRN;
use App\Models\PurchaseRequest_Items;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class QuantityController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id', 'ASC') ->get();
        $totalOrderCount = Order::count();
        return view ('quantity.index', compact('product', 'totalOrderCount'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view ('quantity.edit', compact('product'));
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
        
        
        $product = Product::findOrFail($id);
        $validate = Validator::make($request->all(), [
            
            
            'product_quantity' => 'required'
        ],[
            
            'product_quantity.required' => 'Please enter product quantity price!',
            
        ]);

        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
          }
        
          $requestData = $request->all();
        $product->update($requestData);

        return redirect()->route ('quantity.index')->with('success', 'Quantity updated successfully');
    }

    public function show($id)
    {
        $product = Product::with('productCategory')->findOrFail($id);
        return view ('quantity.show', compact('product'));
    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::orderBy('created_at', 'ASC') ->get();
        return view ('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validate = Validator::make($request->all(), [
            'supplier_name' => 'required',
            'supplier_phone' => 'required',
            'supplier_address' => 'required',
            'supplier_details' => 'required',
        ],[
            'supplier_name.required' => 'Please enter supplier name!',
            'supplier_phone.required' => 'Please enter supplier phone number!',
            'supplier_address.required' => 'Please enter supplier address!',
            'supplier_details.required' => 'Please enter supplier description!',
            
        ]);

        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
          }
        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Supplier added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view ('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view ('supplier.edit', compact('supplier'));
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
        $supplier = Supplier::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'supplier_name' => 'required',
            'supplier_phone' => 'required',
            'supplier_address' => 'required',
            'supplier_details' => 'required',
        ],[
            'supplier_name.required' => 'Please enter supplier name!',
            'supplier_phone.required' => 'Please enter supplier phone number!',
            'supplier_address.required' => 'Please enter supplier address!',
            'supplier_details.required' => 'Please enter supplier description!',
            
        ]);

        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
          }

        $supplier->update($request->all());

        return redirect()->route ('supplier.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return redirect()->route ('supplier.index')->with('success', 'Supplier deleted successfully');
    }
}

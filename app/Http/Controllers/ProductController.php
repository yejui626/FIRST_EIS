<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id', 'ASC') ->get();
        return view ('product.index', compact('product'));
    }

    public function quantity()
    {
        
        return view ('product.quantity', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('product.create');
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
            'product_name' => 'required|min:5',
            'product_code' => 'required',
            'product_details' => 'required',
            'product_sellingprice' => 'required',
            'product_supplierprice' => 'required',
            'product_img1' => 'required',
            'product_details' => 'required'
        ],[
            'product_name.required' => 'Please enter a product name!',
            'product_code.required' => 'Please enter a product code!',
            'product_details.required' => 'Please enter product description!',
            'product_sellingprice.required' => 'Please enter selling price!',
            'product_supplierprice.required' => 'Please enter supplier price!',
            'product_img1.required' => 'Please upload at least first image!',
            'product_name.min' => 'Product name must be at least 5 letters long!',
        ]);
if($validate->fails()){
  return back()->withErrors($validate->errors())->withInput();
}
        
        $requestData = $request->all();

        if ($request->hasFile('product_img1')) {
            $fileName = time() . $request->file('product_img1')->getClientOriginalName();
            $path = $request->file('product_img1')->storeAs('images', $fileName, 'public');
            $requestData["product_img1"] = '/storage/' . $path;
        }
        
        if ($request->hasFile('product_img2')) {
            $fileName = time() . $request->file('product_img2')->getClientOriginalName();
            $path = $request->file('product_img2')->storeAs('images', $fileName, 'public');
            $requestData["product_img2"] = '/storage/' . $path;
        }
        
        if ($request->hasFile('product_img3')) {
            $fileName = time() . $request->file('product_img3')->getClientOriginalName();
            $path = $request->file('product_img3')->storeAs('images', $fileName, 'public');
            $requestData["product_img3"] = '/storage/' . $path;
        }
        
        Product::create($requestData);

        return redirect()->route('product.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view ('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view ('product.edit', compact('product'));
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
            'product_name' => 'required|min:5',
            'product_code' => 'required',
            'product_details' => 'required',
            'product_sellingprice' => 'required',
            'product_supplierprice' => 'required',
            
            'product_details' => 'required'
        ],[
            'product_name.required' => 'Please enter a product name!',
            'product_code.required' => 'Please enter a product code!',
            'product_details.required' => 'Please enter product description!',
            'product_sellingprice.required' => 'Please enter selling price!',
            'product_supplierprice.required' => 'Please enter supplier price!',
            
            'product_name.min' => 'Product name must be at least 5 letters long!',
        ]);

        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
          }
        $requestData = $request->all();
        
        if ($request->hasFile('product_img1')) {
            $fileName = time() . $request->file('product_img1')->getClientOriginalName();
            $path = $request->file('product_img1')->storeAs('images', $fileName, 'public');
            $requestData["product_img1"] = '/storage/' . $path;
        }
    
        if ($request->hasFile('product_img2')) {
            $fileName = time() . $request->file('product_img2')->getClientOriginalName();
            $path = $request->file('product_img2')->storeAs('images', $fileName, 'public');
            $requestData["product_img2"] = '/storage/' . $path;
        }
    
        if ($request->hasFile('product_img3')) {
            $fileName = time() . $request->file('product_img3')->getClientOriginalName();
            $path = $request->file('product_img3')->storeAs('images', $fileName, 'public');
            $requestData["product_img3"] = '/storage/' . $path;
        }
        
        $product->update($requestData);

        return redirect()->route ('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route ('product.index')->with('success', 'Product deleted successfully');
    }
}

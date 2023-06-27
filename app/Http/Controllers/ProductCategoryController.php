<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productcategory =  ProductCategory::OrderBy('category_id', 'ASC')->get();
        return view('productcategory.index',compact('productcategory'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('productcategory.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([ 
            'category_name' => 'required', 
        ]);

        ProductCategory::create($request->all());
        
        return redirect()->route('productcategory.index')
        ->with('success','Product Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productcategory)
    {
       //;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productcategory)
    {
        return view('productcategory.edit',compact('productcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productcategory)
    {
        $request ->validate([ 
            'category_name' => 'required', 
        ]);

        $productcategory->update($request->all());

        return redirect()->route('productcategory.index')
        ->with('success','Product Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productcategory)
{
    try {
        $productcategory->delete();
    } catch (QueryException $exception) {
        if ($exception->getCode() == 23000) {
            // Handle the foreign key constraint violation error
            return redirect()->route('productcategory.index')->with('error', 'Cannot delete the category because it is referenced by some products.');
        }

        // Handle other types of database exceptions if needed

        throw $exception;
    }

    return redirect()->route('productcategory.index')->with('success', 'Product Category deleted successfully!');
}
}

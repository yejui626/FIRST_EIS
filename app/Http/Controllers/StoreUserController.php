<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use App\Models\GRN;
use App\Models\Order;

class StoreUserController extends Controller
{
    public function dashboard()
{
    // Add your logic to fetch data specific to store users and pass it to the view

    $totalOrderCount = Order::count();
    $productCount = Product::count();
    $pendingPurchaseRequestCount = PurchaseRequest::where('status', 'pending')->count();
    $grnCount = GRN::count();

    $products = Product::orderBy('product_quantity', 'asc')->paginate(5);

    return view('store.dashboard', compact('productCount', 'totalOrderCount', 'pendingPurchaseRequestCount', 'grnCount', 'products'));
}

}

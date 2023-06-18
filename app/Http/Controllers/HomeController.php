<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequest_Items;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 3) {
            return redirect()->route('store_dashboard');
        }
        
        $purchaserequest = PurchaseRequest::all();
        $request_items = PurchaseRequest_Items::all();
        $purchaseOrderCount = PurchaseOrder::count();
        $pendingRequestCount = PurchaseRequest::where('status', 'Pending')->count();
        $productCount = Product::count();
        $supplierCount = Supplier::count();
        
        return view('pages.dashboard', compact('purchaseOrderCount', 'pendingRequestCount', 'productCount', 'supplierCount', 'purchaserequest', 'request_items'));
    }

    
}

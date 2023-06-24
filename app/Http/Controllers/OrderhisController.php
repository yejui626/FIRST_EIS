<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Items;
use App\Models\Product;
use App\Models\Logistic;

class OrderhisController extends Controller
{
    public function index()
    {
        return view('home.orderhistory');
    }


    public function records(Request $request)
    {
        if ($request->ajax()) {
            if ($request->input('start_date') && $request->input('end_date')) {
                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

                if ($end_date->greaterThan($start_date)) {
                    $items = Order::with('payment', 'items.product')->whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $items = Order::with('payment', 'items.product')->latest()->get();
                }
            } else {
                $items = Order::with('payment', 'items.product')->latest()->get();
            }

            $formattedItems = $items->map(function ($order) {
                $formattedItems = $order->items->map(function ($item) use ($order) {
                    $product = $item->product;

                    return [
                        'id' => $order->id,
                        'product_name' => $product->product_name,
                        'product_sellingprice' => $product->product_sellingprice,
                        'product_images' => [
                            $product->product_img1
                        ],
                        'product_quantity' => $item->product_quantity,
                        'total_price' => $product->product_sellingprice * $item->product_quantity,
                    ];
                });

                return [
                    'id' => $order->id,
                    'totalprice' => $order->totalprice, // Replace 'totalprice' with the actual field name from the 'orders' table
                    'delivery_status' => $order->delivery_status, // Replace 'delivery_status' with the actual field name from the 'orders' table
                    'created_at' => $order->created_at, // Replace 'created_at' with the actual field name from the 'orders' table
                    'payment' => $order->payment,
                    'items' => $formattedItems,
                ];
            });

            return response()->json([
                'order' => $formattedItems,
            ]);
        } else {
            abort(403);
        }
    }
}

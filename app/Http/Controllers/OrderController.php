<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Logistic;


class OrderController extends Controller
{
public function index()
    {
        $order = Order::orderBy('id', 'ASC') ->get();
        return view ('order.index', compact('order'));
    }

    public function edit(Order $order)
    {
        $statuses = ['Packing', 'Unpack', 'Transfer to logistic']; // Replace with your actual order statuses
        return View::make('orders.edit', compact('order', 'statuses'));
    }
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:Packing,Unpack,Transfer to logistic', // Add validation rules for status field
        ]);

        $order->delivery_status = $validatedData['status'];
        $order->save();

        // Create a new Logistic record if status is "Transfer to logistic"
        if ($order->delivery_status === 'Transfer to logistic') {
            $logistic = new Logistic();
            $logistic->order_id = $order->id;
            $logistic->sender_name = $order->user->name; 
            $logistic->recipient_name = $order->payment->cardname;
            $logistic->recipient_phone = $order->payment->phone;
            $logistic->recipient_address = $order->payment->address;
            $logistic->recipient_address_state = $order->payment->address_state;
            $logistic->recipient_address_city = $order->payment->address_city;
            $logistic->recipient_address_postcode = $order->payment->address_postcode;
            // Access the product through items relationship
            $product = $order->items->first()->product;
            $logistic->description = $product->product_name;
            $logistic->save();
        }

        // Redirect or return response as needed
        return redirect()->route ('order.index')->with('success', 'Status updated successfully');
    }
}
?>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{

    public function index()
    {
        $orders = Order::latest()->get();

        return view('adminordersindex', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);

        return response()->json($order);
    }


    public function accept($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'accepted';

        $order->save();

        return response()->json(['success' => true]);
    }


    public function reject($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'rejected';

        $order->save();

        return redirect('/admin');
    }


    public function rekap($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'rekap';

        $order->save();

        return redirect('/admin');
    }
}

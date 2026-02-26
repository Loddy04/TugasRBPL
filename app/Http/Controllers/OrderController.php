<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Untuk menampilkan form input order
    public function create()
    {
        return view('inputorder');
    }

    // Untuk menyimpan order (PB-02)
    public function store(Request $request)
    {
        $request->validate([
            'items.*.item_name' => 'required',
            'items.*.quantity' => 'required|integer',
            'items.*.price' => 'required|numeric',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf'
        ]);

        $filePath = $request->file('payment_proof')
            ->store('payment_proofs', 'public');

        $total = 0;

        foreach ($request->items as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        $order = Order::create([
            'user_id' => session('user')->id,
            'payment_proof' => $filePath,
            'total' => $total,
            'status' => 'Menunggu Konfirmasi'
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price'],
            ]);
        }

        return redirect('/sales')->with('success', 'Order berhasil dikirim!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderProduct;
use App\Order;

class OrderProductController extends Controller
{
    public function destroy($id)
    {
        $orderproduct = OrderProduct::findOrFail($id);
        // Mengurangi total order
        $order = Order::findOrFail($orderproduct->order_id);
        $order->total = $order->total - $orderproduct->subtotal;
        $order->update();

        $orderproduct->delete();
        
        return redirect()->back()->with('success','Items deleted successfully');
    }
}

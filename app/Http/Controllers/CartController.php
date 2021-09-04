<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Product;

class CartController extends Controller
{
    public function setCart(Request $request)
    {
        $id = $request->product_id;
        $product = Product::findOrFail($id);
        $rules = [
            'product_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required|numeric|min:1'
        ];

        $messages = [
            'product_id.required' => 'Silahkan pilih product!',
            'qty.required' => 'Masukkan quantity!',
            'qty.numeric' => 'Nilai tidak diketahui!',
            'qty.min' => 'Masukkan minimal 1 barang'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $cart = Session::get('items');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $id => [
                    "id" => $id,
                    "product_name" => $product->product_name,
                    "price" => $product->price,
                    "qty" => $request->qty
                ]
            ];
            session()->put('items', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['qty'] += $request->qty;
            session()->put('items', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id" => $id,
            "product_name" => $product->product_name,
            "price" => $product->price,
            "qty" => $request->qty
        ];
        session()->put('items', $cart);

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function removeItem($id)
    {
        $cartList = Session::get('items');
        // Reset session
        Session::pull('items');
        
        unset($cartList[$id]);
        Session::put('items', $cartList);

        return redirect()->back()->with('success', 'Item remove from cart successfully!');
    }

    public function removeCart() {
		session()->forget('items');
		echo "Data telah dihapus dari session.";
	}
}

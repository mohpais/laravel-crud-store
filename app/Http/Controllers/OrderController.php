<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;
use Validator;
use App\Order;
use App\Product;
use App\OrderProduct;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->paginate;
        $orders = Order::where('id', '!=', Null)
            ->search($request)
            ->sort($request)
            ->paginate($page ? $page : 5);

        return view('orders.index', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('items')){
			$carts = session()->get('items');
		} else {
			$carts = array();
		}
        $products = Product::all();
        $order = Order::latest()->paginate(5);

        return view('orders.create', compact('orders', 'products', 'carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'order_date' => 'required',
                'customer_name' => 'required'
            ];
    
            $messages = [
                'order_date.required' => 'Masukkan tanggal order!',
                'customer_name.required' => 'Masukkan nama customer!'
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
    
            $carts = Session::get('items');
            if(!$carts){
                return redirect()->back()->with('error', 'Silahkan masukkan data product!');
            }
    
            $total = 0;
            foreach ($carts as $key => $value) {
                $total += $value['price'] * $value['qty'];
            }
            
            $gen = $this->generateID($request->order_date);
            if (!$gen)
                return redirect()->back()->with('error', 'Error when generating id');
            $order = new Order;
            $order->id = (int)$gen;
            $order->customer_name = $request->customer_name;
            $order->order_date = Carbon::parse($request->order_date);
            $order->total = $total;

            $order->save();

            foreach ($carts as $key => $value) {
                $orderprod = new OrderProduct;
                $orderprod->order_id = $gen;
                $orderprod->product_id = $value['id'];
                $orderprod->customer = $request->customer_name;
                $orderprod->qty = $value['qty'];
                $orderprod->sub_total = $value['price'] * $value['qty'];

                $orderprod->save();
            }

            Session::forget('items');

            $ord_result = Order::findOrFail($order->id);
            $pro_result = OrderProduct::where('order_id', $order->id)
                ->join('products', 'products.id', '=', 'order_products.product_id')
                ->get(['order_products.*', 'products.product_name', 'products.price']);
            Session::flash('success', 'Berhasil membuat order!');
            return redirect()->back()->with(['orders' => $ord_result , 'orderproducts' => $pro_result]);
        } catch (\Excepcion $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function generateID($date)
    {
        try {
            if (!isset($date)) {
                return false;
            }
            $dt = strtotime($date);
            $gd = getDate($dt); 
            $year = $gd['year'];
            $month = $gd['mon'];
            if ($month <= 9)
                $month = '0'.(string)$month;
            $order = Order::count();
            $count = $order + 1;
            if ($count <= 9)
                $count = '0'.(string)$count;
            $num = "0000";
            $number = substr($num, 0, 0-strlen($count));

            return (string)$year.(string)$month.$number.$count;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            // $/ = OrderProduct::where('order_id', $id)->get();
            $products = OrderProduct::select(
                "order_products.id",
                "order_products.qty",
                "order_products.sub_total",
                "products.id",
                "products.product_name",
                "products.price"
            )
            ->leftJoin("products", "products.id", "=", "order_products.product_id")
            ->where('order_id', $id)
            ->get();

            return view('orders.show', compact('order', 'products'));
        } catch (\Exception $e) {
            Session::flash('errors', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = OrderProduct::select(
            "order_products.id",
            "order_products.qty",
            "order_products.sub_total",
            "products.id",
            "products.product_name",
            "products.price"
        )
        ->leftJoin("products", "products.id", "=", "order_products.product_id")
        ->where('order_id', $order->id)
        ->get();

        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $rules = [
            'order_date' => 'required',
            'customer_name' => 'required'
        ];

        $messages = [
            'order_date.required' => 'Masukkan tanggal order!',
            'customer_name.required' => 'Masukkan nama customer!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $orderprodget = OrderProduct::where('order_id', $order->id)->get();
        foreach ($orderprodget as $key => $value) {
            $orderprod = OrderProduct::findOrFail($value->id);
            $orderprod->customer = $request->customer_name;
            $orderprod->update();
        }

        $order->customer_name = $request->customer_name;
        $order->order_date = Carbon::parse($request->order_date);
        $order->update();

        Session::flash('success', 'Success updating order!');
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        Session::flash('success', 'Successfully delete order!');
        return redirect()->back();
    }
}

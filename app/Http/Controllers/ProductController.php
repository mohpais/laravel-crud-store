<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use Validator;
use Session;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('is_admin')->except('logout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $page = $request->paginate;
        $products = Product::where('id', '!=', Null)
            ->search($request)
            ->sort($request)
            ->paginate($page ? $page : 5);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name' => 'required',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|numeric|min:1',
        ];

        $messages = [
            'product_name.required' => 'Nama product wajib diisi',
            'price.required' => 'Masukkan harga!',
            'price.numeric' => 'Nilai tidak diketahui!',
            'price.min' => 'Masukkan harga minimal Rp 1.000',
            'stock.required' => 'Masukkan stock!',
            'price.numeric' => 'Nilai tidak diketahui!',
            'price.min' => 'Masukkan minimal 1 stock'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        
        $slug = $this->makeSlug($request->product_name);
        if (!$slug) {
            Session::flash('error', 'Slug tidak tergenerate!');
            return redirect()->back();
        }

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->user_id = auth()->id();
        $product->slug = $slug;
        $product->price = $request->price;
        $product->stock = $request->stock;

        $product->save();
        
        return redirect()->route('product.index')->with('success','Product created successfully.');
    }

    public function makeSlug($string){
        try {
            $slug = trim($string);
            $slug = preg_replace('/[^a-zA-Z0-9 -]/', '', $slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
            $slug = str_replace(' ', '-', $slug); // replace spaces by dashes
            $slug = strtolower($slug);  // make it lowercase

            return $slug;
        } catch (Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        Session::flash('success', "Success updating product!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success','Product deleted successfully');
    }
}

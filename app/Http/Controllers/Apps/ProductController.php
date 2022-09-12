<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::when(request()->q, function($products) {
            $products = $products->where('title', 'like', '%' . request()->q .'%');
        })->latest()->paginate(10);

        return Inertia::render('Apps/Product/Index', [
            'products'  => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::all();

        return Inertia::render('Apps/Product/Create', [
            'categories'  => $categories,
            'types'  => $types
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'barcode' => 'required|unique:products',
            'description'=> 'required',
            'buy_price'=> 'required',
            'sell_price'=> 'required',
            'category_id'=> 'required',
            'types_id'   => 'nullable',
            'stock' => 'required'
        ]);

        if($request->types_id == ''){
            Product::create([
                'title' => $request->title,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'buy_price' => $request->buy_price,
                'sell_price' => $request->sell_price,
                'category_id' => $request->category_id,
                'stock' => $request->stock
            ]);
        } else {
            Product::create([
                'title' => $request->title,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'buy_price' => $request->buy_price,
                'sell_price' => $request->sell_price,
                'category_id' => $request->category_id,
                'types_id' => $request->types_id,
                'stock' => $request->stock
            ]);
        }
        
        return redirect()->route('apps.products.index');
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
        $categories = Category::all();
        $types = Type::all();

        return Inertia::render('Apps/Product/Edit', [
            'categories'  => $categories,
            'types'  => $types,
            'product'   => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        $this->validate($request, [
            'title'     => 'required',
            'barcode' => 'required',
            'description'=> 'required',
            'buy_price'=> 'required',
            'sell_price'=> 'required',
            'category_id'=> 'required',
            'types_id'   => 'nullable',
            'stock' => 'required'
        ]);

        if($request->types_id == ''){
            $product->update([
                'title' => $request->title,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'buy_price' => $request->buy_price,
                'sell_price' => $request->sell_price,
                'category_id' => $request->category_id,
                'stock' => $request->stock
            ]);
        } else {
            $product->update([
                'title' => $request->title,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'buy_price' => $request->buy_price,
                'sell_price' => $request->sell_price,
                'category_id' => $request->category_id,
                'types_id' => $request->types_id,
                'stock' => $request->stock
            ]);
        }

        return redirect()->route('apps.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('apps.products.index');
    }
}

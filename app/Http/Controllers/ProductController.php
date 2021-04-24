<?php

namespace App\Http\Controllers;

use App\Http\Requests\validateProduct;
use App\Product;
use App\sections;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        $produits = Product::all();
        return view('products.products', compact('sections', 'produits'));
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
    public function store(validateProduct $request)
    {

        $validated = $request->validated();

        Product::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,

        ]);
        session()->flash('Add', 'Produit ajouté avec succée');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate(
            [
                'product_name' => 'required|max:255|unique:products,product_name,' . $request->id,
                'description' => 'required',
            ],
            [
                'product_name.unique' => 'Produit existe déja',
            ]
        );
        $product = product::find($request->id);
        $product->update([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('updated', 'Produit modifié avec succés');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        Product::find($request->id)->delete();
        session()->flash('delete', 'Produit supprimé avec succée');
        return redirect('/products');
    }
}

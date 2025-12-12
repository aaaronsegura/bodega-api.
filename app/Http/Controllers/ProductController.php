<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return Product::orderBy('price', 'asc')->get(); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar que los datos vengan bien
    $request->validate([
        'sku' => 'required|unique:products',
        'name' => 'required',
        'price' => 'required|numeric',
    ]);

    // 2. Crear el producto en la base de datos
    $product = Product::create($request->all());

    // 3. Devolver el producto creado y código 201 (Created)
    return response()->json($product, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

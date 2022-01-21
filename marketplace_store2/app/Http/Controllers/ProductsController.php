<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'prod_name' => $request->prod_name,
            'prod_description' => $request->prod_description,
            'prod_score'=> $request->prod_score,
            'prod_price' => $request->prod_price,
            'prod_in_stock' => $request->prod_in_stock,
        ]);

        return response()->json($product, 201);
    }
}

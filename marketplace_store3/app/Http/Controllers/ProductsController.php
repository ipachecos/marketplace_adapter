<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        return ['products' => Product::all(), 'main page' => env('APP_URL')];
    }

    public function store(Request $request) {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'score' => $request->score,
            'in_stock'=> $request->in_stock,
        ]);

        return response()->json($product, 201);
    }
}

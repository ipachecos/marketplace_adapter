<?php

namespace App\Services;

use App\Interfaces\ProductsInterface;
use Illuminate\Support\Facades\Http;

class Store3ProductsAdapter implements ProductsInterface
{
    private String $url = "http://localhost:3000/api/store/products";

    public function getProducts(): Array
    {
        $response = Http::get($this->url)->json();
        $products = $this->adaptResponse($response['products']);

        return $products;
    }

    private function adaptResponse(Array $responseJson): Array
    {
        $products = [];
        foreach ($responseJson as $product) {
            $score = $product['score'] / 2;

            $products[] = [
                'id' => "str3_{$product['id']}",
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'score' => $score,
                'quantity_in_stock' => $product['in_stock'],
            ];
        }

        return $products;
    }
}

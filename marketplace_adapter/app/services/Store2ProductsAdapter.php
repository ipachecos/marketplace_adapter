<?php

namespace App\Services;

use App\Interfaces\ProductsInterface;
use Illuminate\Support\Facades\Http;

class Store2ProductsAdapter implements ProductsInterface
{
    private String $url = "http://localhost:8080/api/products";

    public function getProducts(): Array
    {
        $response = Http::get($this->url)->json();
        $products = $this->adaptResponse($response);

        return $products;
    }

    private function adaptResponse(Array $responseJson): Array
    {
        $products = [];
        foreach ($responseJson as $product) {
            $score = $product['prod_score'] / 20;

            $products[] = [
                'id' => "str2_{$product['prod_id']}",
                'name' => $product['prod_name'],
                'price' => $product['prod_price'],
                'description' => $product['prod_description'],
                'score' => $score,
                'quantity_in_stock' => $product['prod_in_stock'],
            ];
        }

        return $products;
    }
}

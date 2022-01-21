<?php

namespace App\Services;

use App\Interfaces\ProductsInterface;
use Illuminate\Support\Facades\Http;

class Store1ProductsAdapter implements ProductsInterface
{
    private String $url = "http://localhost:8000/api";

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
            $score = $product['nota'] / 2;

            $products[] = [
                'id' => "str1_{$product['id']}",
                'name' => $product['nome'],
                'price' => $product['preco'],
                'description' => $product['descricao'],
                'score' => $score,
                'quantity_in_stock' => $product['qtd_estoque'],
            ];
        }

        return $products;
    }
}

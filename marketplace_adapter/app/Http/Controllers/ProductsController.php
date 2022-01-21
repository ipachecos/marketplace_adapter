<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsInterface;
use Illuminate\Routing\Controller;
use App\Services\Store1ProductsAdapter;
use App\Services\Store2ProductsAdapter;
use App\Services\Store3ProductsAdapter;
use Exception;

class ProductsController extends Controller
{
    private ProductsInterface $adapter;

    public function __construct()
    {
        $this->class = Product::class;
    }

    public function index(): Array
    {
        $this->getStoreAdapter();

        return $this->adapter->getProducts();
    }

    public function showAll(): Array
    {
        $store1Adapter = new Store1ProductsAdapter();
        $store2Adapter = new Store2ProductsAdapter();
        $store3Adapter = new Store3ProductsAdapter();

        $store1Products = $store1Adapter->getProducts();
        $store2Products = $store2Adapter->getProducts();
        $store3Products = $store3Adapter->getProducts();

        $products = array_merge($store1Products, $store2Products, $store3Products);

        return $products;
    }

    private function getStoreAdapter()
    {
        $currentStore =  env("CURRENT_STORE");
        $currentAdapterClass = 'App\Services\Store' . $currentStore . 'ProductsAdapter';

        // verifica se o nome da classe corresponde a uma classe válida
        // que implementa a ProductsInterface
        if (is_a($currentAdapterClass, ProductsInterface::class, true))
        {
            $this->adapter = new $currentAdapterClass;
        }
        else
        {
            throw new Exception("Couldn't find defined store");
        }

        // if ($currentStore === "1") {
        //     $this->adapter = new Store1ProductsAdapter();
        // }
        // else if ($currentStore === "2") {
        //     $this->adapter = new Store2ProductsAdapter();
        // }
        // else if ($currentStore === "3") {
        //     $this->adapter = new Store3ProductsAdapter();
        // }
        // else {
        //     throw new Exception("Couldn't find store number");
        // }
    }

}

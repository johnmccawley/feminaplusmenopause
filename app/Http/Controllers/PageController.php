<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class PageController extends Controller
{
    public function buyPage() {
        $products = $this->getProducts();

        return view('buy', compact('products'));
    }

    public function productPage() {
        $products = $this->getProducts();

        return view('product', compact('products'));
    }

    

    private function getProducts() {
        $products = Product::all();

        foreach($products as &$product) {
            $product->price = $this->formatDisplayPrice($product->price);
        }

        return $products;
    }

    private function formatDisplayPrice($amount) {
        $displayPrice = '$' . $amount / 100;
        if (strpos($displayPrice, '.')) {
            $explodedPrice = explode('.', $displayPrice);
            if (strlen($explodedPrice[1]) == 1) {
                $displayPrice .= '0';
            }
        } else {
            $displayPrice .= '.00';
        }

        return $displayPrice;
    }
}

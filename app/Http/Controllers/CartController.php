<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('store.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $productRequest = $request->get('product');

        $product = \App\Product::whereSlug($productRequest['slug']);
        if(!$product->count() || $productRequest['amount'] <= 0) return redirect()->route('home');

        $product = array_merge($productRequest, $product->first(['name', 'price', 'store_id'])->toArray());

        if (session()->has('cart')) {
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');

            if(in_array($product['slug'], $productsSlugs)){
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            }else{
                session()->push('cart', $product);
            }

        } else {
            $products[] = $product;

            session()->put('cart', $products);
        }

        flash('Produto adicionado ao carrinho')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()->route('home');
        }

        $products = session()->get('cart');
        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);

        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');

        flash('Você desistiu da compra!')->info();
        return redirect()->route('home');
    }

    private function productIncrement($slug, $amount, $products)
    {
        return array_map(function($line) use($slug, $amount){
            if($slug == $line['slug']){
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);
    }
}

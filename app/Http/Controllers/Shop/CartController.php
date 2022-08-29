<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CartController extends Controller
{
    //une fonction li t'ajouter un produit au panier, t'ajoutih f une liste rahi mkhebya f la session li wsmha cart,
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
           
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']+=$request->quantity;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->discount_price ? $product->discount_price :$product->price,
                "image" => $product->image
            ];
        }
           
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    //une fonction li t'ne7i un produit ml panier, t7ws 3lih b l'id ta3o w tne7ih
    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    //une fonction li t'retourni chhal kayen mn element f le panier, 
    public function cartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        foreach($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    //une fonction li t'modifier la quantite d'un produit f le panier
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        if($cart[$request->id]==null) return false;
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        return true;
    }

 }

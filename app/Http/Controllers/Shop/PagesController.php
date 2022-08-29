<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

// had controller special bch y'handli les pages ta3 le store
class PagesController extends Controller
{
    //fonction li t'reje3 page d'accueil
    public function index()
    {
        $categories=Category::all();
        return view('shop.index',['categories'=>$categories]);
    }

    //fonction li t'reje3 page ta3 la boutique , elle prend en consideration meme si user y'filtrer par categorie
    public function shop(Request $request)
    {
        $category=null;
        if($request->has('category')){
            $products = Product::where('category_id', $request->category)->orderBy('created_at', 'desc');
            $category= Category::find($request->category);
            if(!$category) return redirect('/');
        }else{
        $products = Product::orderBy('created_at', 'desc');
        }
        $categories = Category::all();
        $products=$products->paginate(10);
        return view('shop.shop',['products'=>$products,'categories'=>$categories,'category'=>$category]);
    }
    
    //fonction li t'reje3 page de un produit specifique
    public function product($id)
    {
        $product = Product::where(['id'=>$id])->with('category')->first();
        if(!$product) return redirect('/');
        return view('shop.product',['product'=>$product]);
    }

    //fonction li t'reje3 page de panier
    public function cart()
    {
        return view('shop.cart');
    }
    
    //fonction li t'reje3 page de checkout (confirmation de la commande)
     public function checkout()
    {
        return view('shop.checkout');
    }

    //fonction li t'reje3 les pages ta3 best sellers 3la 7sab la categorie
    public function bestSeller(Request $request,$id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->withCount('orderItems')->orderBy('order_items_count', 'desc')->paginate(10);
        $category= Category::find($id);
        if(!$category) return redirect('/');
        return view('shop.best-seller',['products'=>$products,'categories'=>$categories,'category'=>$category]);
    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class PagesController extends Controller
{
    //
    public function index()
    {
        $categories=Category::all();
        return view('shop.index',['categories'=>$categories]);
    }

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
    
    public function product($id)
    {
        $product = Product::where(['id'=>$id])->with('category')->first();
        if(!$product) return redirect('/');
        return view('shop.product',['product'=>$product]);
    }

    public function cart()
    {
        return view('shop.cart');
    }
    
     public function checkout()
    {
        return view('shop.checkout');
    }

    public function bestSeller(Request $request,$id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->withCount('orderItems')->orderBy('order_items_count', 'desc')->paginate(10);
        $category= Category::find($id);
        if(!$category) return redirect('/');
        return view('shop.best-seller',['products'=>$products,'categories'=>$categories,'category'=>$category]);
    }
}

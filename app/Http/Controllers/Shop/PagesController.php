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
        return view('shop.index');
    }

    public function shop(Request $request)
    {
        $category=null;
        if($request->has('category')){
            $products = Product::where('category_id', $request->category)->paginate(1);
            $category= Category::find($request->category);
        }else{
        $products = Product::paginate(1);
        }
        $categories = Category::all();
        return view('shop.shop',['products'=>$products,'categories'=>$categories,'category'=>$category]);
    }
    
    public function product($id)
    {
        $product = Product::where(['id'=>$id])->with('category')->first();
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
    
}

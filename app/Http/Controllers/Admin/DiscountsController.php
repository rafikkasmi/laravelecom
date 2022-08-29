<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //fonction  tjib ga3 products, w t'retourni view ta3 la page reduction f admin dashboard
    public function index(Request $request)
    {
        $products = Product::all();
        return view('admin.discounts.index', ['products'=>$products]);
    }


    //fonction  t'retourni la page ta3 modifier une reduction
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        return view('admin.discounts.edit', ['product'=>$product]);
    }

    //fonction  li t'handli formulaire ta3 modification de la reduction,
    public function update(Request $request, $id)
    {
        $request->validate([
            'discount_price' => 'required|numeric',
        ]);
        $product = Product::find($id);
        $product->discount_price = $request->discount_price;
        $product->save();
        return redirect()->route('admin.discounts.index')->with('success', 'Reduction has been updated successfully!');
    }

    //fonction  li t'supprimi le reducton d'un produit
    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $product->discount_price = null;
        $product->save();
        return redirect()->back()->with('success', 'Reduction has been deleted successfully!');
    }
        
    //fonction  t'reje3 ga3 les commandes f view ta3 la page commandes f admin dashboard
    public function orders()
    {
        $orders =Order::paginate(10);
        return view('admin.orders.index', ['orders'=>$orders]);
    }
        
}

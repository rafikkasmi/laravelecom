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
    public function index(Request $request)
    {
        $products = Product::all();
        return view('admin.discounts.index', ['products'=>$products]);
    }

    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        return view('admin.discounts.edit', ['product'=>$product]);
    }

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

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $product->discount_price = null;
        $product->save();
        return redirect()->back()->with('success', 'Reduction has been deleted successfully!');
    }
        
    public function orders()
    {
        $orders =Order::paginate(10);
        return view('admin.orders.index', ['orders'=>$orders]);
    }
        
}

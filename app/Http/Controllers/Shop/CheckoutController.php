<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    //
    public function confirmOrder(Request $request)
    {
         $request->validate([
            'fname' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'address'=> 'required',
            'bankcard'=> 'required',
        ]);

        $user=User::findOrFail(auth()->id());

        if($user->email!=$request->email && User::where('email',$request->email)->where('id','!=',$id)->exists()){
            return redirect()->back()->withErrors(['email'=>'Email already exists']);
        }
        $user->update($request->all());
        
        $cart = session()->get('cart', []);
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => 0,
        ]);
        foreach($cart as $productId => $item) {
            $product = Product::find($productId);
            $orderItem = OrderItem::create([
                'product_id' => $productId,
                'order_id' => $order->id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            $order->total += $item['quantity'] * $item['price'];
        }
        $order->save();
        session()->forget('cart');
        return redirect()->route('index')->with('success', 'Order placed successfully!');
    }

 }

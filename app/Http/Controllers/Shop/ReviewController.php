<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
 
    //fonction li t'handli le formulaire de noter un produit
   public function postReview(Request $request,$id)
    {
        $request->validate([
            'rating' => 'required|numeric|between:0,5',
            'comment' => 'required|string|max:255',
        ]);
        $product = Product::findOrFail($id);
        if(!$product)
        {
            return redirect()->back()->with('error','Product not found');
        }
        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->product_id = $id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        return redirect()->back()->with('success', 'Review has been submitted successfully!');
    }
    
 
}

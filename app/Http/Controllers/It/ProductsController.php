<?php

namespace App\Http\Controllers\It;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::where([
            'it_id'=>auth()->user()->id
        ])->with('category')->get();

        return view('it.products.index',['products'=>$products]);
    }

    public function create(Request $request)
    {
        //
        $categories = Category::all();
        return view('it.products.add',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'       => 'required',
            'price'      => 'required',
            'category_id' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        $data = $request->all();
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
        $data['image'] = '/storage/' . $filePath;
        $data['it_id']=$request->user()->id;
        Product::create($data);
         
        return redirect("/it/products")->withSuccess('Great! Product added');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::all();
        $product = Product::where([
            'id'=>$id,
            'it_id'=>auth()->user()->id
        ])->first();
        return view('it.products.edit',['categories'=>$categories,'product'=>$product]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'       => 'required',
            'price'      => 'required',
            'category_id' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $data['image'] = '/storage/' . $filePath;
        }
        $data['it_id']=$request->user()->id;
        Product::where([
            'id'=>$id,
            'it_id'=>auth()->user()->id
        ])->first()->update($data);

         
        return redirect("/it/products")->withSuccess('Great! Product updated');
    }

      public function destroy($id)
    {
        //
        $produit = Product::where(['id'=>$id,'it_id'=>auth()->user()->id])->first();

        if($produit){
            $produit->delete();
            return redirect("/it/products")->withSuccess('Great! Product deleted');
        }
        return redirect("/it/products")->withError('Error! Product not found');
    }
  
}

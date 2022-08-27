<?php

namespace App\Http\Controllers\It;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories = Category::all();
        return view('it.categories.index',['categories'=>$categories]);
    }

    public function create(Request $request)
    {
        //
        return view('it.categories.add');
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
            'name' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        $data = $request->all();
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
        $data['image'] = '/storage/' . $filePath;
        Category::create($data);
        return redirect()->route('it.categories.index')->with('success', 'Category has been created successfully!');
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
        $category = Category::find($id);
        return view('it.categories.edit',['category'=>$category]);
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
            'name' => 'required|string'
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $data['image'] = '/storage/' . $filePath;
        }
        $category = Category::find($id);
        $category->update($data);
        return redirect()->route('it.categories.index')->with('success', 'Category has been updated successfully!');
    }

      public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('it.categories.index')->with('success', 'Category has been deleted successfully!');
    }
}

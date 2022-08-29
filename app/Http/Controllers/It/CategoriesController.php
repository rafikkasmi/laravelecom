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

    //fonction li treje3 page categories f IT dashboard
    public function index(){
        $categories = Category::all();
        return view('it.categories.index',['categories'=>$categories]);
    }

    //fonction li treje3 page de creation d'une categorie f IT dashboard
    public function create(Request $request)
    {
        //
        return view('it.categories.add');
    }

      //fonction li t'creei une categorie ,t'handli form ta3 page de creation d'une categorie
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


    //fonction li treje3 la page de modification ta3 categorie
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('it.categories.edit',['category'=>$category]);
    }

    //fonction li t'modifier une categorie ,t'handli form ta3 page de modification d'une categorie
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

      //fonction li t'supprimi une categorie
      public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('it.categories.index')->with('success', 'Category has been deleted successfully!');
    }
}

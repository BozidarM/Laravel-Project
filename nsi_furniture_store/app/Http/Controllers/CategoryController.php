<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\RawQueries;

class CategoryController extends Controller
{
    public function index(RawQueries $raw){

        $raw_results = $raw->get_with_raw_query('categories');

        return view('categories', [
            'categories' => Category::with('furniture')->get(),
            'categoriesRaw' => $raw_results
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string'
        ]); 
    
        $category = new Category([
            'name' => $request->get('name'),
        ]);
        $category->save();

        return redirect('/')->with('success', 'Category created.');
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string'
        ]); 

        $category = Category::find($id);
        $category->name =  $request->get('name');
        $category->save();
 
        return redirect('/')->with('success', 'Category updated.');
    }
 
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete(); 
 
        return redirect('/')->with('success', 'Category removed.');
    }
}

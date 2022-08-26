<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use Illuminate\Http\Request;
use App\Services\RawQueries;

class FurnitureController extends Controller
{
    public function index(RawQueries $raw){

        $raw_results = $raw->get_with_raw_query('furniture');

        return view('furniture', [
            'furniture' => Furniture::with('comments','categories')->get(),
            'furnitureRaw' => $raw_results
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'price'=>'required|numeric'
        ]); 
    
        $furniture = new Furniture([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price')
        ]);
        $furniture->save();

        return redirect('/')->with('success', 'Furniture created.');
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'price'=>'required|numeric'
        ]); 

        $furniture = Furniture::find($id);
        $furniture->name =  $request->get('name');
        $furniture->description = $request->get('description');
        $furniture->price = $request->get('price');
        $furniture->save();
 
        return redirect('/')->with('success', 'Furniture updated.');
    }
 
    public function destroy($id)
    {
        $furniture = Furniture::find($id);
        $furniture->delete(); 
 
        return redirect('/')->with('success', 'Furniture removed.');
    }
}

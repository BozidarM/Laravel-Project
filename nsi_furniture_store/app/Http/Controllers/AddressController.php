<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|integer',
            'name'=>'required|string',
            'number'=>'required|integer'
        ]); 
    
        $address = new Address([
            'user_id' => $request->get('user_id'),
            'name' => $request->get('name'),
            'number' => $request->get('number')
        ]);
        $address->save();

        return redirect('/')->with('success', 'Address created.');
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'=>'required|integer',
            'name'=>'required|string',
            'number'=>'required|integer'
        ]); 

        $address = Address::find($id);
        $address->user_id = $request->get('user_id');
        $address->name =  $request->get('name');
        $address->number = $request->get('number');
        $address->save();
 
        return redirect('/')->with('success', 'Address updated.');
    }
 
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete(); 
 
        return redirect('/')->with('success', 'Address removed.');
    }
}

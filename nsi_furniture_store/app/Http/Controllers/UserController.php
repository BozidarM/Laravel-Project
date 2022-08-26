<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RawQueries;

class UserController extends Controller
{
    public function index(RawQueries $raw){

        $raw_results = $raw->get_with_raw_query('users');

        return view('users', [
            'users' => User::with('addresses')->get(),
            'usersRaw' => $raw_results
        ]);
    }
 
   
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique',
            'password'=>'required|password|max:10'
        ]); 
    
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
        $user->save();

        return redirect('/')->with('success', 'User created.');
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique',
            'password'=>'required|password|max:10'
        ]); 

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->save();
 
        return redirect('/')->with('success', 'User updated.');
    }
 
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete(); 
 
        return redirect('/')->with('success', 'User removed.');
    }
}

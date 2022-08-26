<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\RawQueries;

class OrderController extends Controller
{
    public function index(RawQueries $raw){

        $raw_results = $raw->get_with_raw_query('orders');

        return view('orders', [
            'orders' => Order::where('user_id', '=', 1)->with('furniture')->get(),
            'ordersRaw' => $raw_results
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|integer',
            'name'=>'required|string'
        ]); 
    
        $order = new Order([
            'user_id' => $request->get('user_id'),
            'name' => $request->get('name')
        ]);
        $order->save();

        return redirect('/')->with('success', 'Order created.');
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'=>'required|integer',
            'name'=>'required|string'
        ]); 

        $order = Order::find($id);
        $order->user_id = $request->get('user_id');
        $order->name =  $request->get('name');
        $order->save();
 
        return redirect('/')->with('success', 'Order updated.');
    }
 
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete(); 
 
        return redirect('/')->with('success', 'Order removed.');
    }
}

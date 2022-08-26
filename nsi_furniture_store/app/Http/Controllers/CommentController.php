<?php

namespace App\Http\Controllers;

use app\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|integer',
            'furniture_id'=>'required|integer',
            'title'=>'required|string',
            'content'=>'required|string'
        ]); 
    
        $comment = new Comment([
            'user_id' => $request->get('user_id'),
            'furniture_id' => $request->get('furniture_id'),
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ]);
        $comment->save();

        return redirect('/')->with('success', 'Comment created.');
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'=>'required|integer',
            'furniture_id'=>'required|integer',
            'title'=>'required|string',
            'content'=>'required|string'
        ]);

        $comment = Comment::find($id);
        $comment->user_id = $request->get('user_id');
        $comment->furniture_id =  $request->get('furniture_id');
        $comment->title = $request->get('title');
        $comment->content = $request->get('content');
        $comment->save();
 
        return redirect('/')->with('success', 'Comment updated.');
    }
 
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete(); 
 
        return redirect('/')->with('success', 'Comment removed.');
    }
}

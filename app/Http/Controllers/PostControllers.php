<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostControllers extends Controller
{
    public function index () {
        return Post::all();
    }

    public function create () {
     request()->validate([
            'title' =>  'required',
            'content' => 'required',
        ]);
    
        return Post::create([
            'title'  => request('title'),
            'content' => request('content'),
        ]);
    }

    public function update (Post $post) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
    
       $request = $post->update([
            'title' => request('title'),
            'content'=> request('content'),
        ]);
    
        if($request) {
            return ['success' => $request];
        }
    }

    public function destroy (Post $post) {
        $request = $post->delete();
        return ['success' => $request];
    }
}

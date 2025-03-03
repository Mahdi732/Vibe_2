<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request, $postId)
{
    $post = Post::findOrFail($postId);
    $like = $post->likes()->where('user_id', Auth::id())->first();

    if ($like) {
        $like->delete(); 
    } else {
        $post->likes()->create(['user_id' => Auth::id()]);
    }
    return view('partials.like-count', ['post' => $post]);
}

    
}

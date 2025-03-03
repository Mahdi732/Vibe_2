<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    public function index()
    {
        $user = Auth::user();
    
        $friendIds = $user->friends()->pluck('id');
    
        $friendIds[] = $user->id;
        $posts = Post::whereIn('user_id', $friendIds)
                    ->with('user') 
                    ->latest() 
                    ->get();
        return view('Post', compact('posts'));
    }
    
    public function store(Request $request)
    {
    
            $post = new Post();
            $post->user_id = auth()->id();  
            $post->content = $request->content;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
                $post->image = $imagePath;
            }

            $post->save();
            return view('postPubli', compact('post'));
    }

    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);
        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $post->delete();

    }


}

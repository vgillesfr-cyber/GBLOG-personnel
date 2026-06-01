<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $user = auth()->user();
        
        $like = Like::where('user_id', $user->id)
                    ->where('post_id', $post->id)
                    ->first();
        
        if ($like) {
            // Unlike
            $like->delete();
            $message = 'Like retiré avec succès !';
        } else {
            // Like
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
            $message = 'Article liké avec succès !';
        }
        
        return back()->with('success', $message);
    }
}

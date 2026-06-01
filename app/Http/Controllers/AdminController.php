<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'posts' => Post::count(),
            'comments' => Comment::count(),
        ];

        $recentPosts = Post::with('user')->latest()->take(10)->get();
        $recentComments = Comment::with(['user', 'post'])->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentComments'));
    }

    public function posts()
    {
        $posts = Post::with('user')->latest()->paginate(20);
        return view('admin.posts', compact('posts'));
    }

    public function comments()
    {
        $comments = Comment::with(['user', 'post'])->latest()->paginate(20);
        return view('admin.comments', compact('comments'));
    }
}

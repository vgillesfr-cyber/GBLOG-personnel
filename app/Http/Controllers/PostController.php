<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Vérifier que l'utilisateur est le propriétaire
        if (!auth()->user()->isOwner()) {
            abort(403, 'Seul le propriétaire du blog peut publier des articles.');
        }
        
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Vérifier que l'utilisateur est le propriétaire
        if (!auth()->user()->isOwner()) {
            abort(403, 'Seul le propriétaire du blog peut publier des articles.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:5120',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:51200',
            'document' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ]);

        $data = $request->only(['title', 'content']);
        $data['user_id'] = auth()->id();
        $data['media_type'] = 'none';

        // Gérer l'image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts/images', 'public');
            $data['media_type'] = 'image';
        }

        // Gérer la vidéo
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('posts/videos', 'public');
            $data['media_type'] = 'video';
        }

        // Gérer le document
        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('posts/documents', 'public');
            $data['media_type'] = 'document';
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Article publié avec succès !');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user', 'comments.replies.user']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id() && !auth()->user()->isOwner()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id() && !auth()->user()->isOwner()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:5120',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:51200',
            'document' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ]);

        $data = $request->only(['title', 'content']);

        // Gérer l'image
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts/images', 'public');
            $data['media_type'] = 'image';
        }

        // Gérer la vidéo
        if ($request->hasFile('video')) {
            if ($post->video) {
                Storage::disk('public')->delete($post->video);
            }
            $data['video'] = $request->file('video')->store('posts/videos', 'public');
            $data['media_type'] = 'video';
        }

        // Gérer le document
        if ($request->hasFile('document')) {
            if ($post->document) {
                Storage::disk('public')->delete($post->document);
            }
            $data['document'] = $request->file('document')->store('posts/documents', 'public');
            $data['media_type'] = 'document';
        }

        $post->update($data);

        return redirect()->route('posts.show', $post)->with('success', 'Article modifié avec succès !');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id() && !auth()->user()->isOwner()) {
            abort(403);
        }

        // Supprimer tous les médias associés
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        if ($post->video) {
            Storage::disk('public')->delete($post->video);
        }
        if ($post->document) {
            Storage::disk('public')->delete($post->document);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Article supprimé avec succès !');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    public function index()
    {
        if(auth()->user()->is_admin) {
            // Admin menarik semua postingan dari semua user
            $posts = Post::with(['category', 'user'])->latest()->get();
        } else {
            // User biasa hanya menarik postingan miliknya
            $posts = Post::where('user_id', auth()->user()->id)->with(['category'])->latest()->get();
        }

        return view('dashboard.posts.index', [
            'posts' => $posts
        ]);
    }

    // ... (Fungsi store, create, show tetap sama dengan yang kamu miliki)

    public function edit(Post $post)
    {
        // Proteksi: Hanya pemilik atau admin yang bisa edit
        if(!auth()->user()->is_admin && $post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Post $post)
    {
        if(!auth()->user()->is_admin && $post->user_id !== auth()->user()->id) {
            abort(403);
        }

        $rules = [
            'title'       => 'required|max:255',
            'category_id' => 'required',
            'image'       => 'image|file|max:1024',
            'body'        => 'required'
        ];

        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    public function destroy(Post $post)
    {
        if(!auth()->user()->is_admin && $post->user_id !== auth()->user()->id) {
            abort(403);
        }

        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        return response()->json(['slug' => $slug]);
    }
}
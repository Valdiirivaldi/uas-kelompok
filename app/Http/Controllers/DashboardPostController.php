<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Menampilkan daftar postingan di dashboard.
     */
    public function index()
    {
        if(auth()->user()->is_admin) {
            // Admin melihat semua postingan
            $posts = Post::with(['category', 'user'])->latest()->get();
        } else {
            // User biasa melihat postingan sendiri
            $posts = Post::where('user_id', auth()->user()->id)->with(['category'])->latest()->get();
        }

        return view('dashboard.posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Menampilkan form tambah postingan.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Menyimpan postingan baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan detail postingan (SOLUSI ERROR TADI).
     */
    public function show(Post $post)
    {
        // Proteksi akses: Jika bukan admin dan bukan miliknya, maka akses ditolak
        if(!auth()->user()->is_admin && $post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Menampilkan form edit postingan.
     */
    public function edit(Post $post)
    {
        if(!auth()->user()->is_admin && $post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Memperbarui data postingan di database.
     */
    public function update(Request $request, Post $post)
    {
        if(!auth()->user()->is_admin && $post->user_id !== auth()->user()->id) {
            abort(403);
        }

        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // Cek jika slug diganti, validasi unique tetap berjalan
        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Menghapus postingan.
     */
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

    /**
     * Fungsi otomatis generate slug (AJAX).
     */
    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        return response()->json(['slug' => $slug]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;    // TAMBAHKAN INI
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class DashboardPostController extends Controller
{
    /**
     * Menampilkan daftar post (READ)
     */
public function index()
{
    return view('dashboard.index', [
        'posts_count' => Post::where('user_id', auth()->user()->id)->count(),
        'categories_count' => Category::count(),
        'users_count' => User::count(),
        // Ambil 5 komentar terbaru untuk post milik user yang sedang login
        'recent_comments' => Comment::whereHas('post', function($query) {
            $query->where('user_id', auth()->user()->id);
        })->with(['user', 'post'])->latest()->take(5)->get()
    ]);
}
    /**
     * Menampilkan form create (CREATE - View)
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Menyimpan data baru (CREATE - Action)
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'slug'        => 'required|unique:posts',
            'category_id' => 'required',
            'image'       => 'image|file|max:1024', // Max 1MB
            'body'        => 'required'
        ]);

        // 2. Upload Gambar (Jika ada)
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // 3. Tambah data manual (User ID & Excerpt)
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        // 4. Simpan ke DB
        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan detail post (READ - Show)
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Menampilkan form edit (UPDATE - View)
     * SAYA UBAH parameter dari 'string $id' menjadi 'Post $post' (Route Model Binding)
     */
    public function edit(Post $post)
    {
        // Cek kepemilikan user
        if($post->author->id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Mengupdate data (UPDATE - Action)
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title'       => 'required|max:255',
            'category_id' => 'required',
            'image'       => 'image|file|max:1024',
            'body'        => 'required'
        ];

        // Validasi Slug (Hanya cek unik jika slug berubah)
        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        // Cek Gambar Baru
        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            // Upload gambar baru
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)
            ->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Menghapus data (DELETE)
     */
    public function destroy(Post $post)
    {
        // Hapus gambar fisik
        if ($post->image) {
            Storage::delete($post->image);
        }

        // Hapus data DB
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    /**
     * Helper untuk Fetch API Slug (Agar otomatis muncul)
     */
    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        return response()->json(['slug' => $slug]);
    }
}


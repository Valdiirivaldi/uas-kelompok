<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN PUBLIC ---
Route::get('/', function () {
    return view('home', ["title" => "Home", "active" => "home"]);
});

Route::get('/about', function () {
    return view('about', ["title" => "About", "active" => "about"]);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});


// --- 2. HALAMAN AUTH (Login & Register) ---
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


// --- 3. HALAMAN DASHBOARD (User & Admin) ---
Route::middleware(['auth'])->group(function() {
    
    // Route Utama Dashboard - Mengirim data statistik & komentar terbaru
    Route::get('/dashboard', function() {
     return view('dashboard.index', [
        'posts_count' => Post::where('user_id', auth()->user()->id)->count(),
        'total_posts_count' => Post::count(), // Variabel baru untuk Admin
        'categories_count' => Category::count(),
        'users_count' => User::count(),
        'recent_comments' => Comment::with(['user', 'post'])->latest()->take(5)->get()
    ]);
    });

    // Fitur Postingan Dashboard
    Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
    Route::resource('/dashboard/posts', DashboardPostController::class);
    
    // Fitur Komentar & Profile
    Route::post('/comment', [CommentController::class, 'store']);
    Route::get('/dashboard/profile', [DashboardProfileController::class, 'index']);
    Route::put('/dashboard/profile', [DashboardProfileController::class, 'update']);
});


// --- 4. HALAMAN KHUSUS ADMIN (Middleware Admin) ---
Route::middleware(['admin'])->group(function() {
    // Kelola Kategori
    Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug']);
    Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');
    
    // Kelola User
    Route::resource('/dashboard/users', AdminUserController::class)->only(['index', 'destroy', 'update']);
});
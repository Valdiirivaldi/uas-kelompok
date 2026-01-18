<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;

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


// --- 2. HALAMAN AUTH ---
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


// --- 3. HALAMAN DASHBOARD (User & Admin) ---
Route::middleware(['auth'])->group(function() {
    
    // PERBAIKAN DI SINI: Mengirim variabel statistik ke dashboard
    Route::get('/dashboard', function() {
        return view('dashboard.index', [
            'posts_count' => Post::where('user_id', auth()->user()->id)->count(),
            'categories_count' => Category::count(),
            'users_count' => User::count()
        ]);
    });

    Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
    Route::resource('/dashboard/posts', DashboardPostController::class);
});
Route::post('/comment', [CommentController::class, 'store'])->middleware('auth');
Route::get('/dashboard', [DashboardPostController::class, 'index'])->middleware('auth');

// Route untuk resource posts tetap biarkan seperti ini:
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
// --- 4. HALAMAN KHUSUS ADMIN ---
Route::middleware(['admin'])->group(function() {
    Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug']);
    Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');
    
    // Resource User Management
    Route::resource('/dashboard/users', AdminUserController::class)->only(['index', 'destroy', 'update']);
});
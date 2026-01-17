<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController; // Pastikan controller ini ada nanti

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN PUBLIC (Bisa diakses tanpa login) ---
Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => "home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about"
    ]);
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


// --- 3. HALAMAN DASHBOARD (Hanya untuk User yang sudah Login) ---
Route::middleware(['auth'])->group(function() {
    
    // Halaman Utama Dashboard
    Route::get('/dashboard', function() {
        return view('dashboard.index');
    });

    // Fitur Kelola Post (Untuk User Biasa/Author & Admin)
    Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
    Route::resource('/dashboard/posts', DashboardPostController::class);

});


// --- 4. HALAMAN KHUSUS ADMIN (Hanya is_admin = 1) ---
Route::middleware(['admin'])->group(function() {
    
    // Tambahkan ini untuk auto-slug kategori
    Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug']);
    
    Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');
});
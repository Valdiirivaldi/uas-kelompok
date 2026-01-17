@extends('layouts.main')

@section('container')
<style>
    /* Efek Zoom saat card di-hover */
    .category-card {
        overflow: hidden; /* Supaya gambar gak keluar kotak pas di-zoom */
        border-radius: 10px;
        transition: transform 0.3s ease;
    }
    .category-card:hover img {
        transform: scale(1.1); /* Zoom in gambar */
    }
    .category-card:hover .card-title {
        background-color: rgba(0,0,0,0.85) !important; /* Background text makin gelap */
    }
    .card-img {
        transition: transform 0.5s ease;
    }
</style>

<h1 class="mb-5 text-center fw-bold">Post Categories</h1>

<div class="container">
    <div class="row justify-content-center">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <a href="/posts?category={{ $category->slug }}" class="text-decoration-none text-white">
                <div class="card bg-dark text-white border-0 category-card shadow">
                    
                    {{-- GAMBAR DINAMIS: Mengambil dari Unsplash berdasarkan Nama Kategori --}}
                    <img src="https://source.unsplash.com/500x500?{{ $category->name }}" 
                         class="card-img" 
                         alt="{{ $category->name }}" 
                         style="height: 350px; object-fit: cover;">
                    
                    <div class="card-img-overlay d-flex align-items-center p-0">
                        <h5 class="card-title text-center flex-fill p-4 fs-3 fw-bold" 
                            style="background-color: rgba(0,0,0,0.6); backdrop-filter: blur(2px);">
                            {{ $category->name }}
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
@extends('layouts.main')

@section('container')
<style>
    /* 1. Memberikan warna background abu-abu muda pada body agar Card Putih menonjol */
    body {
        background-color: #f4f6f9 !important;
    }

    /* 2. Styling Card Utama */
    .card {
        background-color: #ffffff; /* Pastikan card putih bersih */
        border: 1px solid rgba(0, 0, 0, 0.05); /* Garis tepi tipis banget */
        border-radius: 12px; /* Sudut membulat */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); /* Bayangan halus */
        transition: all 0.3s ease;
        height: 100%;
        overflow: hidden;
    }

    /* 3. Efek Hover: Card naik sedikit + bayangan menebal */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        border-color: rgba(0, 0, 0, 0.1);
    }

    /* 4. Mengatur Gambar Grid agar tidak gepeng */
    .card-img-top {
        width: 100%;
        height: 250px;
        object-fit: cover;
        object-position: center;
    }

    /* 5. Mengatur Gambar Hero (Paling Atas) */
    .hero-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        object-position: center;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    /* 6. Badge Kategori */
    .category-badge {
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(5px); /* Efek blur kaca */
        border-radius: 0 0 10px 0;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        transition: background-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
    }
</style>

    <h1 class="mb-4 text-center fw-bold mt-4" style="color: #333;">{{ $title }}</h1>

    {{-- Search Bar --}}
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <form action="/posts">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group shadow-sm" style="border-radius: 50px; overflow: hidden;">
                    <input type="text" class="form-control border-0 py-3 px-4" placeholder="Search articles..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger px-4" type="submit"><i class="bi bi-search"></i> Search</button>
                </div>
            </form> 
        </div>
    </div>

   @if ($posts->count())
    {{-- HERO POST (Postingan Utama) --}}
    <div class="card mb-5 border-0">
        @if ($posts[0]->image)
            <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top hero-img" alt="{{ $posts[0]->category->name }}">
        @else
            <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top hero-img" alt="{{ $posts[0]->category->name }}">
        @endif
        
        <div class="card-body text-center p-4">
            <h2 class="card-title mt-2">
                <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark fw-bold">{{ $posts[0]->title }}</a>
            </h2>
            <p class="mb-3 text-secondary">
                <small>
                    By <a href="/posts?author={{ $posts[0]->author?->username }}" class="text-decoration-none fw-bold">{{ $posts[0]->author?->name ?? 'Unknown' }}</a> 
                    in 
                    <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none fw-bold">{{ $posts[0]->category->name }}</a> 
                    • {{ $posts[0]->created_at->diffForHumans() }}
                </small>
            </p>
            <p class="card-text px-md-5 text-muted">{{ $posts[0]->excerpt }}</p>
            <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary mt-3 px-4">Read more</a>
        </div>
    </div>

    {{-- GRID POSTS (Postingan Lainnya) --}}
    <div class="container p-0">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    {{-- Badge Category --}}
                    <div class="position-absolute px-3 py-2 text-white category-badge">
                         <a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none text-uppercase fw-bold">{{ $post->category->name }}</a>
                    </div>

                    {{-- Gambar --}}
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="card-img-top">
                    @else
                        <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                    @endif
                    
                    {{-- Body Card --}}
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold mb-3">
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                        </h5>
                        
                        <p class="mb-3">
                            <small class="text-muted">
                                By <a href="/posts?author={{ $post->author?->username }}" class="text-decoration-none">{{ $post->author?->name ?? 'Unknown' }}</a> 
                                <br>
                                <span class="text-secondary" style="font-size: 0.8em;">
                                    <i class="bi bi-clock me-1"></i>{{ $post->created_at->diffForHumans() }}
                                </span>
                            </small>
                        </p>

                        <p class="card-text text-secondary small flex-grow-1">{{ Str::limit($post->excerpt, 100) }}</p>
                        
                        <a href="/posts/{{ $post->slug }}" class="btn btn-outline-primary mt-auto w-100 fw-bold">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
        <div class="text-center my-5">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" alt="No Data" width="100" class="mb-3 opacity-50">
            <p class="fs-4 text-secondary fw-bold">No post found.</p>
            <p class="text-muted">Try searching for something else.</p>
            <a href="/posts" class="btn btn-outline-danger mt-2">Clear Filter</a>
        </div>
    @endif

    <div class="d-flex justify-content-center mt-5 mb-5">
        {{ $posts->links() }}
    </div>
@endsection
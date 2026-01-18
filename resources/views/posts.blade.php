@extends('layouts.main')

@section('container')
<style>
    body { background-color: #f4f6f9 !important; }
    .card { background-color: #ffffff; border: 1px solid rgba(0, 0, 0, 0.05); border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); transition: all 0.3s ease; height: 100%; overflow: hidden; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); }
    .card-img-top { width: 100%; height: 250px; object-fit: cover; }
    .hero-img { width: 100%; height: 400px; object-fit: cover; }
    .category-badge { background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px); border-radius: 0 0 10px 0; z-index: 2; }
</style>

<h1 class="mb-4 text-center fw-bold mt-4" style="color: #333;">{{ $title }}</h1>

{{-- Search Bar --}}
<div class="row justify-content-center mb-5">
    <div class="col-md-6">
        <form action="/posts">
            @if (request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if (request('author')) <input type="hidden" name="author" value="{{ request('author') }}"> @endif
            <div class="input-group shadow-sm" style="border-radius: 50px; overflow: hidden;">
                <input type="text" class="form-control border-0 py-3 px-4" placeholder="Search articles..." name="search" value="{{ request('search') }}">
                <button class="btn btn-danger px-4" type="submit"><i class="bi bi-search"></i> Search</button>
            </div>
        </form> 
    </div>
</div>

@if ($posts->count())
    
    @if ($posts->onFirstPage())
        {{-- HERO POST (Hanya di Halaman 1) --}}
        <div class="card mb-5 border-0 shadow-lg">
            @if ($posts[0]->image)
                <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top hero-img" alt="{{ $posts[0]->category->name }}">
            @else
                {{-- Ganti Unsplash ke Picsum --}}
                <img src="https://picsum.photos/seed/{{ $posts[0]->category->name }}/1200/400" class="card-img-top hero-img" alt="Default Image">
            @endif
            
            <div class="card-body text-center p-4">
                <h2 class="card-title mt-2">
                    <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark fw-bold">{{ $posts[0]->title }}</a>
                </h2>
                <p class="mb-3 text-secondary">
                    <small>
                        By <a href="/posts?author={{ $posts[0]->author?->username }}" class="text-decoration-none fw-bold">{{ $posts[0]->author?->name ?? 'Unknown' }}</a> 
                        in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none fw-bold">{{ $posts[0]->category->name }}</a> 
                        • {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text px-md-5 text-muted">{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($posts[0]->body)), 200) }}</p>
                <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary mt-3 px-4">Read more</a>
            </div>
        </div>

        {{-- GRID UNTUK SISA POST DI HALAMAN 1 --}}
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="position-absolute px-3 py-2 text-white category-badge">
                         <a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none text-uppercase fw-bold" style="font-size: 0.75rem;">{{ $post->category->name }}</a>
                    </div>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="card-img-top">
                    @else
                        <img src="https://picsum.photos/seed/{{ $post->id }}/500/400" class="card-img-top" alt="Default Image">
                    @endif
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold mb-3">
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                        </h5>
                        <p class="mb-3">
                            <small class="text-muted">By {{ $post->author?->name ?? 'Unknown' }} <br> {{ $post->created_at->diffForHumans() }}</small>
                        </p>
                        <p class="card-text text-secondary small flex-grow-1">{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($post->body)), 100) }}</p>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-outline-primary mt-auto w-100 fw-bold">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    @else
        {{-- GRID UNTUK HALAMAN 2, 3, DST --}}
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="position-absolute px-3 py-2 text-white category-badge">
                         <a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none text-uppercase fw-bold" style="font-size: 0.75rem;">{{ $post->category->name }}</a>
                    </div>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="card-img-top">
                    @else
                        <img src="https://picsum.photos/seed/{{ $post->id }}/500/400" class="card-img-top" alt="Default Image">
                    @endif
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold mb-3">
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                        </h5>
                        <p class="mb-3 small text-muted">By {{ $post->author?->name ?? 'Unknown' }} <br> {{ $post->created_at->diffForHumans() }}</p>
                        <p class="card-text text-secondary small flex-grow-1">{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($post->body)), 100) }}</p>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-outline-primary mt-auto w-100 fw-bold">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

@else
    <p class="text-center fs-4">No post found.</p>
@endif

<div class="d-flex justify-content-center mt-5">
    {{ $posts->links() }}
</div>
@endsection
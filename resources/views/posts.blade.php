@extends('layouts.main')

@section('container')
    <style>
        /* CSS Tambahan untuk Mempercantik Card */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        /* Efek Hover: Card naik dan bayangan menebal */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
        }

        /* Memastikan gambar seragam */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        /* Badge kategori di pojok gambar */
        .category-badge {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 0 0 10px 0;
            font-size: 0.9rem;
        }

        .btn-primary {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
        }
    </style>

    <h1 class="mb-4 text-center fw-bold">{{ $title }}</h1>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="/posts">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3 shadow-sm">
                    <input type="text" class="form-control" placeholder="Search articles..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger px-4" type="submit">Search</button>
                </div>
            </form> 
        </div>
    </div>

   @if ($posts->count())
    <div class="card mb-5 shadow border-0">
        <img src="{{ asset('img/tes.jpg') }}" class="card-img-top" alt="{{ $posts[0]->category->name }}" style="max-height: 400px;">        
        <div class="card-body text-center p-4">
            <h2 class="card-title mt-2">
                <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark fw-bold">{{ $posts[0]->title }}</a>
            </h2>
            <p class="mb-3">
                <small class="text-muted">
                    By. <a href="/posts?author={{ $posts[0]->author?->username }}" class="text-decoration-none">{{ $posts[0]->author?->name ?? 'Unknown' }}</a> 
                    in 
                    <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a> 
                    • {{ $posts[0]->created_at->diffForHumans() }}
                </small>
            </p>
            <p class="card-text px-md-5">{{ $posts[0]->excerpt }}</p>
            <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary mt-3">Read more</a>
        </div>
    </div>

    <div class="container p-0">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="position-absolute px-3 py-2 text-white category-badge">
                         <a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a>
                    </div>

                    <img src="{{ asset('img/gambar1.jpg') }}" alt="{{ $post->category->name }}" class="card-img-top">                    
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <p class="mb-2">
                            <small class="text-muted">
                                By. <a href="/posts?author={{ $post->author?->username }}" class="text-decoration-none">{{ $post->author?->name ?? 'Unknown' }}</a> 
                                <br>
                                <i class="bi bi-clock me-1"></i>{{ $post->created_at->diffForHumans() }}
                            </small>
                        </p>
                        <p class="card-text text-secondary small">{{ Str::limit($post->excerpt, 100) }}</p>
                        
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary mt-auto">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
        <div class="text-center my-5">
            <p class="fs-4 text-secondary">No post found.</p>
            <a href="/posts" class="btn btn-outline-danger">Clear Filter</a>
        </div>
    @endif

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
@endsection
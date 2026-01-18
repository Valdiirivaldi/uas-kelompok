@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            
            <div class="mb-4">
                 <a href="/posts" class="text-decoration-none text-secondary">
                    <i class="bi bi-arrow-left"></i> Back to posts
                 </a>
            </div>

            <h1 class="mb-3 fw-bold display-5">{{ $post->title }}</h1>
            
            <div class="d-flex align-items-center mb-4 text-muted border-bottom pb-3">
                <span class="me-2">By</span>
                <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none fw-bold text-dark me-2">
                    {{ $post->author?->name ?? 'Admin' }}
                </a> 
                <span class="me-2">in</span> 
                <a href="/posts?category={{ $post->category->slug }}" class="badge bg-primary text-decoration-none">
                    {{ $post->category->name }}
                </a>
                <span class="mx-2">•</span> 
                <span>{{ $post->created_at->format('d F Y') }}</span>
            </div>

            <div class="overflow-hidden rounded-4 shadow-sm mb-5">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                @else
                    <img src="https://picsum.photos/seed/{{ $post->category->name }}/1200/500" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                @endif
            </div>
            
            <article class="my-3 fs-5 lh-lg text-break">
                   {!! $post->body !!} 
            </article>   

            <div class="mt-5 pt-4 border-top">
                <p class="text-muted fst-italic mb-2">Terima kasih sudah membaca!</p>
                <a href="/posts" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

        </div> 
    </div>
</div>
@endsection
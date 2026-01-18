@extends('layouts.main')

@section('container')
<style>
    /* Tipografi & Layout Minimalis */
    .post-container { max-width: 800px; margin: auto; }
    .post-body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.8; color: #212529; font-size: 1.15rem; }
    .post-body p { margin-bottom: 1.5rem; }
    
    /* Hero Image */
    .hero-wrapper { border-radius: 15px; overflow: hidden; margin-bottom: 3rem; }
    .hero-img { width: 100%; height: auto; object-fit: cover; }

    /* Comment Section Clean */
    .comment-card { border: none; border-bottom: 1px solid #f0f0f0; padding: 1.5rem 0; }
    .comment-card:last-child { border-bottom: none; }
    .comment-input { border: 1px solid #dee2e6; border-radius: 10px; padding: 1rem; background-color: #f8f9fa; }
    .comment-input:focus { background-color: #fff; border-color: #0d6efd; box-shadow: none; }
    
    .meta-text { font-size: 0.9rem; color: #6c757d; }

    /* Custom Like Button */
    .btn-like {
        transition: all 0.3s ease;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
    }
    .btn-like:hover { transform: translateY(-2px); }
    .fill-red { fill: #dc3545; color: #dc3545 !important; }
</style>

<div class="container py-5">
    <div class="post-container">
        
        {{-- Tombol Kembali/Back --}}
        <div class="mb-4">
            <a href="/posts" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left"></i> BACK TO POSTS
            </a>
        </div>

        {{-- Header Artikel --}}
        <header class="mb-5">
            <h1 class="fw-bold mb-3" style="line-height: 1.2;">{{ $post->title }}</h1>
            
            <div class="d-flex align-items-center py-3 border-bottom border-top justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name) }}&background=0D6EFD&color=fff" class="rounded-circle me-3" width="45" height="45">
                    <div>
                        <span class="meta-text d-block">
                            By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none fw-bold text-dark">{{ $post->author?->name ?? 'Admin' }}</a> 
                            in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none fw-bold text-primary">{{ $post->category->name }}</a>
                        </span>
                        <span class="meta-text">{{ $post->created_at->format('d F Y') }}</span>
                    </div>
                </div>

                {{-- FITUR LIKE (Header Version) --}}
                <div>
                    @auth
                        <form action="/post/{{ $post->slug }}/like" method="post">
                            @csrf
                            <button type="submit" class="btn btn-like {{ $post->isLikedBy(auth()->user()) ? 'btn-danger text-white' : 'btn-outline-danger' }}">
                                <i data-feather="heart" class="{{ $post->isLikedBy(auth()->user()) ? 'fill-current' : '' }}" style="width: 18px; height: 18px;"></i>
                                <span class="ms-1 small">{{ $post->likes->count() }}</span>
                            </button>
                        </form>
                    @else
                        <a href="/login" class="btn btn-like btn-outline-danger">
                            <i data-feather="heart" style="width: 18px; height: 18px;"></i>
                            <span class="ms-1 small">{{ $post->likes->count() }}</span>
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        {{-- Gambar Utama/Main --}}
        <div class="hero-wrapper shadow-sm">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="hero-img">
            @else
                <img src="https://picsum.photos/seed/{{ $post->id }}/1200/700" class="hero-img">
            @endif
        </div>
        
        {{-- Konten Artikel --}}
        <article class="post-body mb-5">
               {!! $post->body !!} 
        </article>

        {{-- FITUR LIKE (Bottom Version - Opsional) --}}
        <div class="d-flex justify-content-center my-5">
            @auth
                <form action="/post/{{ $post->slug }}/like" method="post">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-like shadow-sm {{ $post->isLikedBy(auth()->user()) ? 'btn-danger text-white' : 'btn-outline-danger' }}">
                        <i data-feather="heart" style="width: 24px; height: 24px;"></i> 
                        Sukai Artikel Ini ({{ $post->likes->count() }})
                    </button>
                </form>
            @endauth
        </div>

        <hr class="my-5">

        {{-- Bagian Komentar --}}
        <section id="comments">
            <h4 class="fw-bold mb-4">Comments ({{ $post->comments->count() }})</h4>

            @auth
            <div class="mb-5">
                <form action="/comment" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="mb-3">
                        <textarea class="form-control comment-input shadow-none" name="body" rows="3" placeholder="Write a comment..." required></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Post Comment</button>
                    </div>
                </form>
            </div>
            @else
            <div class="alert alert-light border rounded-3 text-center mb-5">
                Please <a href="/login" class="fw-bold">Login</a> to join the conversation.
            </div>
            @endauth

            <div class="comment-list pb-5">
                @forelse ($post->comments->sortByDesc('created_at') as $comment)
                <div class="comment-card">
                    <div class="d-flex align-items-center mb-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=6c757d&color=fff" 
                             class="rounded-circle me-2" width="35" height="35">
                        <span class="fw-bold text-dark me-2" style="font-size: 0.95rem;">{{ $comment->user->name }}</span>
                        <small class="text-muted" style="font-size: 0.8rem;">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="ps-1 text-secondary" style="line-height: 1.5;">
                        {{ $comment->body }}
                    </div>
                </div>
                @empty
                <p class="text-center text-muted">No comments yet.</p>
                @endforelse
            </div>
        </section>

    </div> 
</div>

{{-- Script Feather Icons (Jika belum ada di layout main) --}}
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>

@endsection
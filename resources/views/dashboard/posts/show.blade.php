@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                <h1 class="fw-bold text-dark mb-3">{{ $post->title }}</h1>
                
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex gap-2">
                        <a href="/dashboard/posts" class="btn btn-light text-secondary border-0 shadow-sm px-3" style="border-radius: 10px;">
                            <i class="fa-solid fa-arrow-left me-1"></i> Back
                        </a>
                        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-light text-warning border-0 shadow-sm px-3" style="border-radius: 10px;">
                            <i class="fa-regular fa-pen-to-square me-1"></i> Edit
                        </a>
                        <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-light text-danger border-0 shadow-sm px-3" style="border-radius: 10px;" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fa-regular fa-trash-can me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                    <div>
                        <span class="badge px-3 py-2" style="background-color: #eff6ff; color: #1d4ed8; border-radius: 8px;">
                            <i class="fa-solid fa-tag me-1 small"></i> {{ $post->category->name }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm overflow-hidden mb-4" style="border-radius: 20px;">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" style="width: 100%; max-height: 500px; object-fit: cover;">
                @else
                    <img src="https://picsum.photos/seed/{{ $post->id }}/1200/600" class="img-fluid">
                @endif
            </div>

            <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 20px;">
                <article class="fs-5 text-dark" style="line-height: 1.8; color: #334155 !important;">
                    {!! $post->body !!}
                </article>
            </div>
        </div>
    </div>
</div>
@endsection
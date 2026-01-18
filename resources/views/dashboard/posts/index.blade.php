@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 fw-bold" style="color: #334155;">
        {{ auth()->user()->is_admin ? 'Management All Posts' : 'My Personal Posts' }}
    </h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm col-lg-12" role="alert" style="border-radius: 12px; background-color: #dcfce7; color: #166534;">
    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow-sm mb-5" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <a href="/dashboard/posts/create" class="btn btn-primary border-0 fw-bold py-2 px-4 shadow-sm" style="border-radius: 12px; background: linear-gradient(45deg, #4f46e5, #6366f1);">
            <i class="fa-solid fa-plus me-2"></i> Create New Post
        </a>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8fafc;">
                    <tr>
                        <th scope="col" class="ps-4 py-3 text-secondary small fw-bold text-uppercase">#</th>
                        <th scope="col" class="py-3 text-secondary small fw-bold text-uppercase">Title</th>
                        <th scope="col" class="py-3 text-secondary small fw-bold text-uppercase">Category</th>
                        @if(auth()->user()->is_admin)
                            <th scope="col" class="py-3 text-secondary small fw-bold text-uppercase">Author</th>
                        @endif
                        <th scope="col" class="py-3 text-center text-secondary small fw-bold text-uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                        <td class="ps-4 text-secondary small">{{ $loop->iteration }}</td>
                        <td>
                            <span class="fw-bold text-dark d-block" style="font-size: 0.95rem;">{{ $post->title }}</span>
                            <small class="text-muted">Published {{ $post->created_at->format('d M Y') }}</small>
                        </td>
                        <td>
                            <span class="badge px-3 py-2" style="border-radius: 8px; background-color: #eff6ff; color: #1d4ed8; font-weight: 600;">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        
                        @if(auth()->user()->is_admin)
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name ?? 'Guest') }}&size=30&background=random&color=fff" class="rounded-circle me-2 shadow-sm">
                                <span class="small fw-medium text-secondary">{{ $post->user->name ?? 'User' }}</span>
                            </div>
                        </td>
                        @endif

                        <td class="text-center pe-3">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- View Icon --}}
                                <a href="/dashboard/posts/{{ $post->slug }}" class="btn btn-sm btn-light text-info border-0 shadow-sm" style="border-radius: 8px; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" title="View Detail">
                                    <i class="fa-regular fa-eye"></i>
                                </a>

                                {{-- Edit Icon --}}
                                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-light text-warning border-0 shadow-sm" style="border-radius: 8px; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" title="Edit Post">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>

                                {{-- Delete Icon --}}
                                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-light text-danger border-0 shadow-sm" style="border-radius: 8px; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" onclick="return confirm('Yakin ingin menghapus?')" title="Delete Post">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
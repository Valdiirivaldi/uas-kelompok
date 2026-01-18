@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 fw-bold" style="color: #334155;">
        {{ auth()->user()->is_admin ? 'All User Posts' : 'My Posts' }}
    </h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm col-lg-10" role="alert">
    <span data-feather="check-circle" class="me-2"></span>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
    <div class="table-responsive">
        <a href="/dashboard/posts/create" class="btn btn-primary mb-3 fw-bold py-2 px-4" style="border-radius: 10px;">
            <span data-feather="plus" class="me-1"></span> Create New Post
        </a>

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="py-3">#</th>
                    <th scope="col" class="py-3">Title</th>
                    <th scope="col" class="py-3">Category</th>
                    @if(auth()->user()->is_admin)
                        <th scope="col" class="py-3">Author</th>
                    @endif
                    <th scope="col" class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-medium text-dark">{{ $post->title }}</td>
                    <td>
                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2" style="border-radius: 8px;">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    
                    @if(auth()->user()->is_admin)
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name ?? 'Guest') }}&size=25&background=random" class="rounded-circle me-2">
                            <span class="small fw-bold text-secondary">{{ $post->user->name ?? 'Deleted User' }}</span>
                        </div>
                    </td>
                    @endif

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            {{-- View --}}
                            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info p-2 border-0" style="text-decoration: none;">
                                <span data-feather="eye"></span>
                            </a>

                            {{-- Edit --}}
                            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning p-2 border-0" style="text-decoration: none;">
                                <span data-feather="edit"></span>
                            </a>

                            {{-- Delete --}}
                            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0 p-2" onclick="return confirm('Yakin ingin menghapus?')">
                                    <span data-feather="x-circle"></span>
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
@endsection
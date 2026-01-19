@extends('dashboard.layouts.main')

@section('container')
{{-- Header Selamat Datang --}}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 fw-bold" style="color: var(--bs-heading-color, #334155);">Selamat Datang, {{ auth()->user()->name }}</h1>
</div>

{{-- Row Kartu Statistik --}}
<div class="row">
    {{-- Card My Posts --}}
    <div class="{{ auth()->user()->is_admin ? 'col-md-4' : 'col-md-6' }} col-lg-3 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #4e73df, #224abe); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">My Posts</h6>
                        <h2 class="fw-bold mb-0">{{ $posts_count }}</h2>
                    </div>
                    <span data-feather="file-text" style="width: 40px; height: 40px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Likes Received --}}
    <div class="{{ auth()->user()->is_admin ? 'col-md-4' : 'col-md-6' }} col-lg-3 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #e74a3b, #be2617); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">Likes Received</h6>
                        <h2 class="fw-bold mb-0">{{ $total_likes }}</h2>
                    </div>
                    <span data-feather="heart" style="width: 40px; height: 40px; opacity: 0.3; fill: rgba(255,255,255,0.2);"></span>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->is_admin)
    {{-- Total All Posts --}}
    <div class="col-md-4 col-lg-2 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #f66d9b, #d8336d); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">Total Posts</h6>
                        <h2 class="fw-bold mb-0 text-truncate" style="max-width: 80px;">{{ $total_posts_count }}</h2>
                    </div>
                    <span data-feather="layers" style="width: 30px; height: 30px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Categories --}}
    <div class="col-md-6 col-lg-2 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #1cc88a, #13855c); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">Categories</h6>
                        <h2 class="fw-bold mb-0">{{ $categories_count }}</h2>
                    </div>
                    <span data-feather="grid" style="width: 30px; height: 30px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Users --}}
    <div class="col-md-6 col-lg-2 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #f6c23e, #dda20a); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">Users</h6>
                        <h2 class="fw-bold mb-0">{{ $users_count }}</h2>
                    </div>
                    <span data-feather="users" style="width: 30px; height: 30px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- TABEL KOMENTAR TERBARU --}}
<div class="row mt-2 mb-5">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header border-0 pt-4 px-4 bg-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <span data-feather="message-square" class="text-primary"></span>
                    </div>
                    <h5 class="fw-bold mb-0">Komentar Terbaru</h5>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3 small text-uppercase fw-bold text-secondary">User</th>
                                <th class="py-3 small text-uppercase fw-bold text-secondary">Komentar</th>
                                <th class="py-3 small text-uppercase fw-bold text-secondary">Postingan</th>
                                <th class="text-end px-4 py-3 small text-uppercase fw-bold text-secondary">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_comments as $comment)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&size=32" class="rounded-circle me-2 shadow-sm">
                                        <span class="small fw-bold">{{ $comment->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted small">"{{ Str::limit($comment->body, 55) }}"</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge rounded-pill bg-info bg-opacity-10 text-info fw-medium px-3 py-2" style="font-size: 0.75rem;">
                                        {{-- REVISI DISINI: Pakai tanda tanya --}}
                                        {{ Str::limit($comment->post?->title, 35) }}
                                    </span>
                                </td>
                                <td class="text-end px-4 py-3 text-secondary small">
                                    {{ $comment->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted small">
                                    <span data-feather="coffee" class="mb-2 d-block mx-auto opacity-25" style="width: 40px; height: 40px;"></span>
                                    Belum ada komentar baru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
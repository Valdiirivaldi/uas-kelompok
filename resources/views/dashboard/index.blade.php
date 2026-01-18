@extends('dashboard.layouts.main')

@section('container')
{{-- Header Selamat Datang --}}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 fw-bold" style="color: #334155;">Selamat Datang, {{ auth()->user()->name }}</h1>
</div>

{{-- Row Kartu Statistik --}}
<div class="row">
    {{-- Card My Posts --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #4e73df, #224abe); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">My Posts</h6>
                        <h2 class="fw-bold mb-0">{{ $posts_count }}</h2>
                    </div>
                    <span data-feather="file-text" style="width: 45px; height: 45px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->is_admin)
    {{-- Card Total Categories --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #1cc88a, #13855c); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">Categories</h6>
                        <h2 class="fw-bold mb-0">{{ $categories_count }}</h2>
                    </div>
                    <span data-feather="grid" style="width: 45px; height: 45px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Total Users --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(45deg, #f6c23e, #dda20a); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 small opacity-75 fw-bold">Total Users</h6>
                        <h2 class="fw-bold mb-0">{{ $users_count }}</h2>
                    </div>
                    <span data-feather="users" style="width: 45px; height: 45px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Row Panduan Cepat --}}
<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 15px; background-color: #f8f9fc;">
            <h5 class="fw-bold mb-3 text-dark"><span data-feather="info" class="me-2 text-primary"></span>Panduan Cepat</h5>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 text-secondary small"><span data-feather="check-circle" class="text-success me-2" style="width: 14px;"></span> Kelola artikel Anda melalui menu <strong>My Posts</strong>.</li>
                        <li class="mb-2 text-secondary small"><span data-feather="check-circle" class="text-success me-2" style="width: 14px;"></span> Tambahkan kategori baru di menu <strong>Post Categories</strong>.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 text-secondary small"><span data-feather="check-circle" class="text-success me-2" style="width: 14px;"></span> Pantau interaksi pembaca pada kolom komentar setiap post.</li>
                        <li class="mb-2 text-secondary small"><span data-feather="check-circle" class="text-success me-2" style="width: 14px;"></span> Gunakan gambar berkualitas tinggi (max 1MB) untuk header post.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TABEL KOMENTAR TERBARU --}}
<div class="row mt-4 mb-5">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 d-flex align-items-center justify-content-center">
                        <span data-feather="message-square" class="text-primary" style="width: 20px; height: 20px;"></span>
                    </div>
                    <h5 class="fw-bold mb-0" style="color: #334155;">Komentar Terbaru</h5>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-3 small text-uppercase fw-bold text-secondary">User</th>
                                <th class="border-0 py-3 small text-uppercase fw-bold text-secondary">Komentar</th>
                                <th class="border-0 py-3 small text-uppercase fw-bold text-secondary">Di Postingan</th>
                                <th class="border-0 py-3 text-end px-4 small text-uppercase fw-bold text-secondary">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_comments as $comment)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&size=32&font-size=0.4" 
                                             class="rounded-circle me-3 shadow-sm" width="32" height="32" alt="avatar">
                                        <span class="small fw-bold text-dark">{{ $comment->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted small italic">"{{ Str::limit($comment->body, 65) }}"</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge rounded-pill bg-info bg-opacity-10 text-info fw-medium px-3 py-2" style="font-size: 0.75rem;">
                                        {{ Str::limit($comment->post->title, 35) }}
                                    </span>
                                </td>
                                <td class="text-end px-4 py-3 text-secondary small">
                                    <span style="font-size: 0.75rem;">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <span data-feather="coffee" class="mb-3 d-block mx-auto" style="width: 40px; height: 40px; opacity: 0.2;"></span>
                                        <p class="small mb-0">Belum ada komentar baru yang masuk.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($recent_comments->count() > 0)
            <div class="card-footer bg-white border-0 text-center py-3">
                <small class="text-muted">Menampilkan 5 aktivitas interaksi terbaru</small>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
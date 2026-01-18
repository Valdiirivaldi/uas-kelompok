@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang, {{ auth()->user()->name }}</h1>
</div>

<div class="row">
    {{-- Card My Posts (Untuk semua user) --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(45deg, #4e73df, #224abe); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1" style="font-size: 0.8rem; opacity: 0.8;">My Posts</h6>
                        <h2 class="fw-bold mb-0">{{ $posts_count }}</h2>
                    </div>
                    <span data-feather="file-text" style="width: 45px; height: 45px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->is_admin)
    {{-- Card Total Categories (Hanya Admin) --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(45deg, #1cc88a, #13855c); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1" style="font-size: 0.8rem; opacity: 0.8;">Categories</h6>
                        <h2 class="fw-bold mb-0">{{ $categories_count }}</h2>
                    </div>
                    <span data-feather="grid" style="width: 45px; height: 45px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Total Users (Hanya Admin) --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(45deg, #f6c23e, #dda20a); border-radius: 15px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1" style="font-size: 0.8rem; opacity: 0.8;">Total Users</h6>
                        <h2 class="fw-bold mb-0">{{ $users_count }}</h2>
                    </div>
                    <span data-feather="users" style="width: 45px; height: 45px; opacity: 0.3;"></span>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 15px; background-color: #f8f9fc;">
            <h5 class="fw-bold mb-3">Panduan Cepat</h5>
            <ul class="list-unstyled">
                <li class="mb-2"><span data-feather="check-circle" class="text-success me-2"></span> Gunakan menu <strong>My Posts</strong> untuk mengelola artikel Anda.</li>
                <li class="mb-2"><span data-feather="check-circle" class="text-success me-2"></span> Anda dapat menambahkan gambar kategori di menu <strong>Post Categories</strong>.</li>
                <li class="mb-2"><span data-feather="check-circle" class="text-success me-2"></span> Status Admin memberikan akses untuk mengelola user di <strong>User Management</strong>.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
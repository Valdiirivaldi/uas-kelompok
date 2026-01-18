@extends('layouts.main')

@section('container')
{{-- HERO SECTION --}}
<div class="row align-items-center py-5">
    <div class="col-lg-6 order-2 order-lg-1">
        <h1 class="display-4 fw-bold lh-1 mb-3 text-dark">Welcome to <span class="text-primary">UAS BLOG</span></h1>
        <p class="lead text-secondary mb-4">
            Tempat berbagi wawasan, tutorial koding, dan cerita menarik seputar dunia teknologi. 
            Jelajahi artikel menarik yang telah kami siapkan.
        </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="/posts" class="btn btn-primary btn-lg px-4 me-md-2 rounded-pill shadow-sm">Mulai Membaca</a>
            <a href="/about" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Tentang Kami</a>
        </div>
    </div>
    <div class="col-lg-6 order-1 order-lg-2 mb-5 mb-lg-0 text-center">
        {{-- Gambar Statis (Anti-Error) --}}
        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
             alt="Hero Image" class="img-fluid rounded-4 shadow-lg">
    </div>
</div>

{{-- FEATURES SECTION --}}
<div class="row mt-5 pt-5 border-top">
    <div class="col-md-4 text-center mb-4">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
            <i class="bi bi-code-slash fs-2"></i>
        </div>
        <h3 class="h4 fw-bold">Programming</h3>
        <p class="text-muted">Tutorial koding terlengkap seputar Laravel & Bootstrap.</p>
    </div>
    <div class="col-md-4 text-center mb-4">
        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
            <i class="bi bi-lightbulb fs-2"></i>
        </div>
        <h3 class="h4 fw-bold">Tips & Trik</h3>
        <p class="text-muted">Cara efektif meningkatkan skill digitalmu.</p>
    </div>
    <div class="col-md-4 text-center mb-4">
        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
            <i class="bi bi-people fs-2"></i>
        </div>
        <h3 class="h4 fw-bold">Community</h3>
        <p class="text-muted">Bergabung dengan komunitas pembaca kami.</p>
    </div>
</div>
@endsection
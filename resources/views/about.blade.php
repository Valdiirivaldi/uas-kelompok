@extends('layouts.main')

@section('container')
<div class="container py-5">
    
    {{-- BAGIAN 1: INTRO & GAMBAR --}}
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                 alt="Team Work" 
                 class="img-fluid rounded-4 shadow-lg">
        </div>
        <div class="col-lg-6">
            <h2 class="display-5 fw-bold mb-3">Tentang <span class="text-primary">UAS Blog</span></h2>
            <p class="lead text-secondary">
                Kami adalah sekelompok mahasiswa yang bersemangat dalam dunia teknologi web. 
                Blog ini dibuat sebagai proyek akhir (UAS) untuk mendemonstrasikan kemampuan kami menggunakan Framework Laravel.
            </p>
            <p class="text-muted">
                Tujuan kami adalah menyajikan konten edukatif yang mudah dipahami oleh pemula. 
                Kami percaya bahwa belajar koding haruslah menyenangkan dan bisa diakses oleh siapa saja.
            </p>
        </div>
    </div>

    {{-- BAGIAN 2: POIN-POIN KEUNGGULAN (BIAR GAK KOSONG) --}}
    <div class="row mb-5 text-center">
        <div class="col-md-4 mb-3">
            <div class="p-4 bg-light rounded-4 border h-100">
                <i class="bi bi-rocket-takeoff text-primary fs-1 mb-3"></i>
                <h5 class="fw-bold">Fast & Modern</h5>
                <p class="text-muted small">Dibangun menggunakan teknologi terbaru Laravel 10 dan Bootstrap 5.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="p-4 bg-light rounded-4 border h-100">
                <i class="bi bi-palette text-danger fs-1 mb-3"></i>
                <h5 class="fw-bold">Clean Design</h5>
                <p class="text-muted small">Tampilan antarmuka yang rapi, responsif, dan nyaman di mata pembaca.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="p-4 bg-light rounded-4 border h-100">
                <i class="bi bi-people text-success fs-1 mb-3"></i>
                <h5 class="fw-bold">Team Work</h5>
                <p class="text-muted small">Hasil kolaborasi solid dari anggota kelompok kami.</p>
            </div>
        </div>
    </div>

    {{-- BAGIAN 3: ANGGOTA KELOMPOK (Tim Section) --}}
    <div class="text-center mb-5">
        <h3 class="fw-bold mb-4">Meet Our Team</h3>
        <div class="row justify-content-center">
            
            {{-- Kartu Anggota 1 (Kamu) --}}
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 text-center py-4 h-100">
                    <div class="card-body">
                        <img src="https://ui-avatars.com/api/?name=Richie&background=0D6EFD&color=fff&size=100" 
                             class="rounded-circle mb-3 shadow-sm" alt="Rici">
                        <h5 class="fw-bold mb-1">Richie</h5>
                        <p class="text-muted small mb-0">Frontend & Design</p>
                    </div>
                </div>
            </div>

            {{-- Kartu Anggota 2 (Temanmu, ganti namanya nanti) --}}
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 text-center py-4 h-100">
                    <div class="card-body">
                        <img src="https://ui-avatars.com/api/?name=Valdi&background=dc3545&color=fff&size=100" 
                             class="rounded-circle mb-3 shadow-sm" alt="Valdi">
                        <h5 class="fw-bold mb-1">Valdi</h5>
                        <p class="text-muted small mb-0">Backend Developer</p>
                    </div>
                </div>
            </div>

            {{-- Kartu Anggota 3 (Temanmu, ganti namanya nanti) --}}
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 text-center py-4 h-100">
                    <div class="card-body">
                        <img src="https://ui-avatars.com/api/?name=Fabian&background=198754&color=fff&size=100" 
                             class="rounded-circle mb-3 shadow-sm" alt="Fabian">
                        <h5 class="fw-bold mb-1">Fabian</h5>
                        <p class="text-muted small mb-0">Fullstack Dev</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
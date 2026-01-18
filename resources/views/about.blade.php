@extends('layouts.main')

@section('container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            {{-- Kartu Tentang Blog --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5">
                <div class="row g-0">
                    {{-- Gambar Ilustrasi --}}
                    <div class="col-md-5">
                        {{-- Pastikan file icon.png ada di public/img/ --}}
                       <img src="{{ asset('img/icon.png') }}" 
                            class="img-fluid h-100 w-100 object-fit-cover" 
                            alt="About UAS Blog"
                            style="min-height: 400px;">
                    </div>
                    
                    {{-- Deskripsi Blog --}}
                    <div class="col-md-7 d-flex align-items-center">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-robot fs-4"></i>
                                </div>
                                <h5 class="text-primary fw-bold text-uppercase m-0">Our Story</h5>
                            </div>
                            
                            <h2 class="card-title fw-bold mb-3">About UAS Blog</h2>
                            
                            <p class="card-text text-muted lh-lg">
                                UAS Blog adalah platform digital yang didedikasikan untuk berbagi pengetahuan seputar teknologi, pemrograman, dan wawasan terbaru di dunia digital.
                            </p>
                            <p class="card-text text-muted lh-lg">
                                Website ini dibangun dengan semangat untuk menghubungkan para pembaca dengan konten berkualitas, serta sebagai sarana eksplorasi dalam pengembangan web modern menggunakan ekosistem Laravel.
                            </p>

                            {{-- Social Media --}}
                            <div class="mt-4 pt-3 border-top">
                                <small class="text-secondary d-block mb-2">Connect with us:</small>
                                <div class="d-flex gap-3">
                                    <a href="#" class="text-dark fs-4"><i class="bi bi-github"></i></a>
                                    <a href="#" class="text-primary fs-4"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="text-danger fs-4"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="text-primary fs-4"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tech Stack Section --}}
            <div class="text-center mt-5 py-4">
                <p class="text-muted text-uppercase letter-spacing-2 mb-4">Powered by Modern Technology</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    
                    <div class="p-3 bg-white shadow-sm rounded-4 d-flex align-items-center gap-3 border transition-hover">
                        <i class="bi bi-box-seam text-danger fs-3"></i>
                        <div class="text-start">
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Framework</small>
                            <span class="fw-bold text-secondary">Laravel 10</span>
                        </div>
                    </div>

                    <div class="p-3 bg-white shadow-sm rounded-4 d-flex align-items-center gap-3 border transition-hover">
                        <i class="bi bi-bootstrap text-primary fs-3"></i>
                        <div class="text-start">
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Frontend</small>
                            <span class="fw-bold text-secondary">Bootstrap 5</span>
                        </div>
                    </div>

                    <div class="p-3 bg-white shadow-sm rounded-4 d-flex align-items-center gap-3 border transition-hover">
                        <i class="bi bi-database text-warning fs-3"></i>
                        <div class="text-start">
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Database</small>
                            <span class="fw-bold text-secondary">MySQL 8.0</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .letter-spacing-2 {
        letter-spacing: 2px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: default;
    }

    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }

    /* Memastikan gambar tetap bagus di layar kecil */
    @media (max-width: 768px) {
        .col-md-5 img {
            min-height: 250px !important;
        }
    }
</style>
@endsection
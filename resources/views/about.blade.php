@extends('layouts.main')

@section('container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            {{-- Kartu Tentang Blog --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5">
                <div class="row g-0">
                    {{-- Gambar Ilustrasi (Ganti foto orang jadi foto Tech/Workspace) --}}
                    <div class="col-md-5">
                        <img src="https://source.unsplash.com/800x1000/?workspace,coding" 
                             class="img-fluid h-100 w-100 object-fit-cover" 
                             alt="About UAS Blog"
                             style="min-height: 350px;">
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
                                Website ini dibangun dengan semangat untuk menghubungkan para pembaca dengan konten berkualitas, serta sebagai sarana eksplorasi dalam pengembangan web modern.
                            </p>

                            {{-- Social Media Generic --}}
                            <div class="mt-4 pt-3 border-top">
                                <small class="text-secondary d-block mb-2">Connect with us:</small>
                                <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-github"></i></a>
                                <a href="#" class="text-primary me-3 fs-5"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="text-danger fs-5"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tech Stack Section (Nilai Plus buat UAS) --}}
            <div class="text-center mt-5">
                <p class="text-muted text-uppercase letter-spacing-2 mb-4">Powered by Modern Technology</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    
                    <div class="p-3 bg-white shadow-sm rounded-4 d-flex align-items-center gap-2 border">
                        <i class="bi bi-box-seam text-danger fs-4"></i>
                        <span class="fw-bold text-secondary">Laravel 10</span>
                    </div>

                    <div class="p-3 bg-white shadow-sm rounded-4 d-flex align-items-center gap-2 border">
                        <i class="bi bi-bootstrap text-primary fs-4"></i>
                        <span class="fw-bold text-secondary">Bootstrap 5</span>
                    </div>

                    <div class="p-3 bg-white shadow-sm rounded-4 d-flex align-items-center gap-2 border">
                        <i class="bi bi-database text-warning fs-4"></i>
                        <span class="fw-bold text-secondary">MySQL</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Sedikit styling tambahan untuk spasi huruf */
    .letter-spacing-2 {
        letter-spacing: 2px;
        font-size: 0.8rem;
        font-weight: 600;
    }
</style>
@endsection
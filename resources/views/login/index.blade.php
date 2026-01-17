@extends('layouts.main')

@section('container')
<div class="row justify-content-center min-vh-100 align-items-center" style="margin-top: -60px;">
    <div class="col-lg-4 col-md-6">

        {{-- Alert Sukses Registrasi --}}
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert Gagal Login --}}
        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-5">
                
                {{-- Header Login dengan Icon --}}
                <div class="text-center mb-4">
                    <div class="bg-primary bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 70px; height: 70px;">
                        <i class="bi bi-person-lock fs-2"></i>
                    </div>
                    <h1 class="h3 fw-bold mb-1">Welcome Back</h1>
                    <p class="text-muted small">Please login to access your dashboard.</p>
                </div>

                <form action="/login" method="POST">
                    @csrf
                    
                    {{-- Input Email --}}
                    <div class="form-floating mb-3">
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control rounded-3 @error('email') is-invalid @enderror" 
                            id="email" 
                            placeholder="name@example.com" 
                            autofocus 
                            required 
                            value="{{ old('email') }}"
                        >
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="form-floating mb-3">
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control rounded-3" 
                            id="password" 
                            placeholder="Password" 
                            required
                        >
                        <label for="password">Password</label>
                    </div>

                    {{-- Tombol Login --}}
                    <button class="w-100 btn btn-lg btn-primary rounded-3 mt-3 fw-bold shadow-sm" type="submit">
                        Log in <i class="bi bi-box-arrow-in-right ms-2"></i>
                    </button>
                </form>

                {{-- Garis Pembatas --}}
                <hr class="my-4 text-muted opacity-25">

                {{-- Footer Link Register --}}
                <div class="text-center">
                    <small class="text-muted">Not registered yet?</small> 
                    <a href="/register" class="text-decoration-none fw-bold ms-1">Create an Account!</a>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- CSS Tambahan Khusus Halaman Login --}}
<style>
    /* Memberikan background abu-abu muda pada body agar Card Putih terlihat menonjol */
    body {
        background-color: #f8f9fa !important;
    }
</style>
@endsection
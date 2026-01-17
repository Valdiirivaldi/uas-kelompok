@extends('layouts.main')

@section('container')
<div class="row justify-content-center min-vh-100 align-items-center" style="margin-top: -60px;">
    <div class="col-lg-5 col-md-7">

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-5">
                
                {{-- Header Register --}}
                <div class="text-center mb-4">
                    <div class="bg-primary bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 70px; height: 70px;">
                        <i class="bi bi-person-plus-fill fs-2"></i>
                    </div>
                    <h1 class="h3 fw-bold mb-1">Create Account</h1>
                    <p class="text-muted small">Join us and start your journey!</p>
                </div>

                <form action="/register" method="POST">
                    @csrf

                    {{-- Input Nama --}}
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                        <label for="name">Full Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Username --}}
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control rounded-3 @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Email --}}
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                        <label for="email">Email Address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Register --}}
                    <button class="w-100 btn btn-lg btn-primary rounded-3 mt-3 fw-bold shadow-sm" type="submit">
                        Register <i class="bi bi-arrow-right-circle ms-2"></i>
                    </button>
                </form>

                {{-- Garis Pembatas --}}
                <hr class="my-4 text-muted opacity-25">

                {{-- Footer ke Login --}}
                <div class="text-center">
                    <small class="text-muted">Already have an account?</small> 
                    <a href="/login" class="text-decoration-none fw-bold ms-1">Login Now!</a>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- CSS Tambahan (Sama dengan Login Page) --}}
<style>
    body {
        background-color: #f8f9fa !important;
    }
</style>
@endsection
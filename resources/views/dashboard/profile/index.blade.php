@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 fw-bold" style="color: #334155;">Pengaturan Profil</h1>
</div>

<div class="row mb-5">
    <div class="col-lg-8">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
            <form method="post" action="/dashboard/profile" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                {{-- Bagian Upload Foto --}}
                <div class="d-flex align-items-center mb-4">
                    <div class="position-relative me-4">
                        @if($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" class="img-preview img-fluid rounded-circle border border-4 border-white shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=100" class="img-preview img-fluid rounded-circle border border-4 border-white shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <label for="image" class="form-label small fw-bold text-secondary">Ubah Foto Profil</label>
                        <input class="form-control form-control-sm @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                        <div class="form-text small">Format: JPG, PNG. Maks 1MB.</div>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-muted opacity-10 mb-4">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name', $user->name) }}" style="border-radius: 10px;">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label small fw-bold text-secondary">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username', $user->username) }}" style="border-radius: 10px;">
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label small fw-bold text-secondary">Alamat Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', $user->email) }}" style="border-radius: 10px;">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4 p-3 bg-light rounded-3">
                    <label for="password" class="form-label small fw-bold text-dark">Ubah Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah" style="border-radius: 10px; border-style: dashed;">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="border-radius: 10px;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 text-center" style="border-radius: 15px; background-color: #f8f9fc;">
            <div class="bg-white rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-shield-lock text-primary fs-3"></i>
            </div>
            <h6 class="fw-bold">Keamanan Akun</h6>
            <p class="small text-muted">Pastikan data Anda selalu diperbarui untuk keamanan akses.</p>
            <hr>
            <p class="small text-secondary mb-0">Bergabung sejak: <br><strong>{{ $user->created_at->format('d M Y') }}</strong></p>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
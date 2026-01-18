@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 fw-bold" style="color: #334155;">Edit Category</h1>
</div>

<div class="row mb-5">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 20px;">
            <form method="post" action="/dashboard/categories/{{ $category->slug }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary">Category Name</label>
                    <input type="text" class="form-control p-3 border-0 bg-light @error('name') is-invalid @enderror" style="border-radius: 12px;" id="name" name="name" required autofocus value="{{ old('name', $category->name) }}">
                </div>

                <div class="mb-4">
                    <label for="slug" class="form-label fw-bold text-secondary">Slug</label>
                    <input type="text" class="form-control p-3 border-0 bg-light @error('slug') is-invalid @enderror" style="border-radius: 12px;" id="slug" name="slug" required value="{{ old('slug', $category->slug) }}">
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold text-secondary">Category Image</label>
                    <input type="hidden" name="oldImage" value="{{ $category->image }}">
                    <div class="mb-3">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" class="img-preview img-fluid d-block shadow-sm" style="border-radius: 15px; max-height: 200px;">
                        @else
                            <img class="img-preview img-fluid shadow-sm" style="border-radius: 15px; max-height: 200px; display: none;">
                        @endif
                    </div>
                    <input class="form-control border-0 bg-light @error('image') is-invalid @enderror" style="border-radius: 12px;" type="file" id="image" name="image" onchange="previewImage()">
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                    <a href="/dashboard/categories" class="btn btn-light px-4 py-2 fw-bold text-secondary" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 10px; background: linear-gradient(45deg, #fbbf24, #f59e0b); border: none;">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    name.addEventListener('change', function() {
        fetch('/dashboard/categories/checkSlug?name=' + name.value).then(res => res.json()).then(data => slug.value = data.slug)
    });
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent) { imgPreview.src = oFREvent.target.result; }
    }
</script>
@endsection
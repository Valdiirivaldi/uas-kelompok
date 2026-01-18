@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 fw-bold" style="color: #334155;">Edit Post</h1>
</div>

<div class="row mb-5">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 20px;">
            <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                <div class="mb-4">
                    <label for="title" class="form-label fw-bold text-secondary">Post Title</label>
                    <input type="text" class="form-control p-3 border-0 bg-light @error('title') is-invalid @enderror" style="border-radius: 12px;" id="title" name="title" required autofocus value="{{ old('title', $post->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="slug" class="form-label fw-bold text-secondary">Slug (URL)</label>
                    <input type="text" class="form-control p-3 border-0 bg-light @error('slug') is-invalid @enderror" style="border-radius: 12px;" id="slug" name="slug" required value="{{ old('slug', $post->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category" class="form-label fw-bold text-secondary">Category</label>
                    <select class="form-select p-3 border-0 bg-light" style="border-radius: 12px;" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold text-secondary">Update Post Image</label>
                    <input type="hidden" name="oldImage" value="{{ $post->image }}">
                    
                    <div class="mb-3">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid d-block mb-3 shadow-sm" style="border-radius: 15px; max-height: 200px;">
                        @else
                            <img class="img-preview img-fluid mb-3 shadow-sm" style="border-radius: 15px; max-height: 200px;">
                        @endif
                    </div>

                    <input class="form-control border-0 bg-light @error('image') is-invalid @enderror" style="border-radius: 12px;" type="file" id="image" name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="body" class="form-label fw-bold text-secondary">Content</label>
                    @error('body') <p class="text-danger small">{{ $message }}</p> @enderror
                    <div class="border-0 bg-light p-2" style="border-radius: 12px;">
                        <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                        <trix-editor input="body" class="bg-light border-0"></trix-editor>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="/dashboard/posts" class="btn btn-light px-4 py-2 fw-bold text-secondary" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 10px; background: linear-gradient(45deg, #4f46e5, #6366f1); border: none;">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i> Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        if (image.files[0]) {
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    }
</script>

<style>
    /* Menghilangkan border toolbar trix agar senada dengan UI clean */
    trix-toolbar .trix-button-row { border-bottom: none; }
    trix-editor { min-height: 300px !important; }
</style>
@endsection 
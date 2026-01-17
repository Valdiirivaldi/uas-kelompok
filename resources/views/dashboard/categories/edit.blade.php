@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/categories/{{ $category->slug }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Category Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $category->name) }}">
        </div>

        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $category->slug) }}">
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Category Image</label>
          <input type="hidden" name="oldImage" value="{{ $category->image }}">
          @if($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
          @else
            <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
          @endif
          <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

<script>
    // Script sama dengan create (Auto-slug & Preview)
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    name.addEventListener('change', function() {
        fetch('/dashboard/categories/checkSlug?name=' + name.value).then(res => res.json()).then(data => slug.value = data.slug)
    });
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent) { imgPreview.src = oFREvent.target.result; }
    }
</script>
@endsection
@extends ('dashboard.layouts.main')

@section('container')

    <div class="container">
        <div class="row  my-3">
           <div class="col-lg-8">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <a href="/dashboard/posts" class="btn btn-success">Back to my posts</a>
            <a href="" class="btn btn-success">Edit</a>
            <a href="" class="btn btn-success">Hapus</a>
        <img src="{{ asset('img/gambar1.jpg') }}" alt="{{ $post->category->name }}" class="img-fluid">
         <article class="my-3 fs-4">
               {!! $post->body !!} 
        </article>   



    <a href="/posts" class="display-block mt-3">Back To posts</a>
        </div> 
        </div>
    </div>

@endsection

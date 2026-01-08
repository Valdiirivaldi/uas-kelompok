@extends ('dashboard.layouts.main')

@section('container')
 <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <h1 class="h2">My Post {{ auth()->user()->name }}</h1>
          </div>

        <div class="table-responsive small">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Category</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->category->name }}</td>
                  <td>
                    <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"><i class="bi bi-eye"></i></span></a>
                    <a href="" class="badge bg-warning"><span data-feather="edit"><i class="bi bi-pencil"></i></span></a>
                    <a href="#" class="badge bg-danger"><span data-feather="x-circle"><i class="bi bi-x-circle"></i></span></a>
                  </td>

                @endforeach
              </tbody>
            </table>
          </div>
@endsection

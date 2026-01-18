@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 fw-bold" style="color: #334155;">Post Categories</h1>
</div>

<div class="card border-0 shadow-sm col-lg-8 mb-5" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <a href="/dashboard/categories/create" class="btn btn-primary border-0 fw-bold py-2 px-4 shadow-sm" style="border-radius: 12px; background: linear-gradient(45deg, #4f46e5, #6366f1);">
            <i class="fa-solid fa-plus me-2"></i> Create New Category
        </a>
    </div>

    <div class="card-body p-0 mt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8fafc;">
                    <tr>
                        <th scope="col" class="ps-4 py-3 text-secondary small fw-bold text-uppercase">#</th>
                        <th scope="col" class="py-3 text-secondary small fw-bold text-uppercase">Category Name</th>
                        <th scope="col" class="py-3 text-center text-secondary small fw-bold text-uppercase">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="border-bottom" style="border-color: #f1f5f9 !important;">
                        <td class="ps-4 text-secondary small">{{ $loop->iteration }}</td>
                        <td>
                            <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $category->name }}</span>
                        </td>
                        <td class="text-center pe-3">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Edit --}}
                                <a href="/dashboard/categories/{{ $category->slug }}/edit" class="btn btn-sm btn-light text-warning border-0 shadow-sm" style="border-radius: 8px; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" title="Edit Category">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-light text-danger border-0 shadow-sm" style="border-radius: 8px; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" onclick="return confirm('Are you sure?')" title="Delete Category">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
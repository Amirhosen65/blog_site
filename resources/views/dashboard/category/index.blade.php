@extends('layouts.dashboard_master')


@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Categories</h1>
        </div>
    </div>
</div>

<div class="row">
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'administrator')
    <div class="col-12">
        @else
        <div class="col-8">
            @endif
        <div class="card">
            <div class="card-header">
                Category List
            </div>
            <div class="card-body ">
                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'administrator')
                        <th scope="col">Action</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>

                        @forelse ($categories as $category)

                      <tr>
                        <th scope="row">{{ $loop->index +1 }}</th>
                        <td>{{ $category->title }}</td>

                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'administrator')
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{ route('category.status', $category->id) }}" method="POST">
                                    @csrf
                                    @if ($category->status == 'active')
                                    <button type="submit" class="btn btn-success btn-sm">Active</button>
                                    @else
                                    <button type="submit" class="btn btn-danger btn-sm">Inactive</button>
                                    @endif
                                </form>

                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}">
                                    Info
                                </button>
                            </div>
                        </td>
                        @else
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">

                                @if ($category->status == 'active')
                                <button type="button" class="btn btn-success btn-sm" onclick="showSweetAlert()">Active</button>
                                @else
                                <button type="button" class="btn btn-danger btn-sm" onclick="showSweetAlert()">Inactive</button>
                                @endif

                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}">
                                Info
                            </button>
                        </div>
                        </td>
                        @endif

                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'administrator')
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('category.edit.index',$category->id) }}" class="btn btn-info btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('category.delete',$category->id) }}" method="POST">
                                    @csrf

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </td>
                        @endif

                      </tr>

                      <!-- Modal -->
                        <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Category Inventory</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center mb-3">
                                                <img src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="" style="height: 200px; width: auto;">
                                            </div>
                                            <h3><b>Title:</b> {{ $category->title }}</h3>
                                            <p><b>Slug:</b> {{ $category->slug }}</p>
                                            <p><b>Created Date:</b> {{ $category->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>

                      @empty
                      <tr>
                        <td colspan="4" class="text-center text-danger"><h3>Category Empty!</h3></td>
                      </tr>


                      @endforelse
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'administrator')
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Category Add
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('category.insert') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control @error('title') is-invalid
                      @enderror" name="title">
                      @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                    </div>
                    <div class="mb-3">
                      <label class="form-label">Slug</label>
                      <input type="text" class="form-control" name="slug">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid
                        @enderror" name="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('footer_script')
        @if (session('success'))
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}",
            })
        </script>

        @endif

        @if (session('error_alert'))
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'error',
            title: "{{ session('error_alert') }}",
            })
        </script>

        <script>

        function showSweetAlert(status) {
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Only Admin and Administrator can change status!',
            });
        }

        </script>

        @endif

        @endsection





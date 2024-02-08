@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Blog Trash</h1>
        </div>
        <div class="d-flex justify-content-end mb-2">
            <form id="deleteAllForm" action="{{ route('blog.delete.all') }}" method="POST">
                @csrf
                <button type="button" class="btn btn-warning btn-sm" onclick="confirmDelete()">
                    Empty All Trash
                </button>
            </form>
        </div>


    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                  <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  @forelse ($blog_trash as $blog)

                                  <tr>
                                    <th scope="row">{{ $blog->id }}</th>
                                    <td><img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="" style="height: 80px; width: auto;"></td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->RelationUser->name }}</td>
                                    <td>{{ $blog->RelationCategory->title }}</td>

                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ route('blog.restore',$blog->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    Restore
                                                </button>
                                            </form>
                                            <form id="individualDeleteForm_{{ $blog->id }}" action="{{ route('blog.forcedelete', $blog->id) }}" method="POST">
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmIndividualDelete({{ $blog->id }})">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                  </tr>
                                  @empty
                                  <tr>
                                    <td colspan="7" class="text-center text-danger"><h3>Blog Trash Empty!</h3></td>
                                  </tr>


                                  @endforelse
                                </tbody>
                              </table>
                        </div>

                          <nav aria-label="...">
                            <ul class="pagination justify-content-end">
                              <li class="page-item {{ $blog_trash->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $blog_trash->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                              </li>

                              @for ($i = 1; $i <= $blog_trash->lastPage(); $i++)
                                <li class="page-item {{ $i == $blog_trash->currentPage() ? 'active' : '' }}">
                                  <a class="page-link" href="{{ $blog_trash->url($i) }}">{{ $i }}</a>
                                </li>
                              @endfor

                              <li class="page-item {{ $blog_trash->currentPage() == $blog_trash->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $blog_trash->nextPageUrl() }}">Next</a>
                              </li>
                            </ul>
                          </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@section('footer_script')

{{-- alert message --}}
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

        @endif

        <script>
            function confirmDelete() {
                // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action will permanently delete all trashed blogs. Continue?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete all',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        document.getElementById('deleteAllForm').submit();
                    }
                });
            }


            function confirmIndividualDelete(blogId) {
                // Show SweetAlert confirmation for individual delete
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action will permanently delete this trashed blog. Continue?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form for individual delete
                        document.getElementById('individualDeleteForm_' + blogId).submit();
                    }
                });
            }


        </script>





@endsection


@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Authors List</h1>
        </div>

    </div>
</div>

@if (auth()->user()->role == 'administrator' || auth()->user()->role == 'admin')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">#</th>

                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>

                            @forelse ($users as $user)

                          <tr>
                            <th scope="row">{{ $users->firstItem() + $loop->index }}</th>

                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge text-bg-success" style="background-color: green; color: white">{{ ucfirst($user->role) }}</span></td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                        <form action="{{ route('authors.block',$user->id) }}" method="POST">
                                            @csrf

                                            <button class="btn btn-warning btn-sm">
                                                Block
                                            </button>
                                        </form>
                                        <form action="{{ route('authors.rejected',$user->id) }}" method="POST" >
                                            @csrf

                                            <button class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>

                                </div>

                            </td>


                          </tr>

                          @empty
                          <tr>
                            <td colspan="6" class="text-center text-danger"><h3>Authors Empty!</h3></td>
                          </tr>


                          @endforelse
                        </tbody>
                      </table>

                      {{-- Pagination --}}
                      <nav aria-label="...">
                        <ul class="pagination justify-content-end">
                          <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                          </li>

                          @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                              <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                            </li>
                          @endfor

                          <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                          </li>
                        </ul>
                      </nav>

                </div>
            </div>
        </div>
    </div>
</div>

@else
<h2 class="text-warning text-center">Only Administrator can access this page!</h2>
@endif

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


        <script>
            function confirmDelete(userId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the form submission for deletion
                        document.getElementById('deleteUser_' + userId).submit();
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                });
            }

            // Swal.fire({
            // title: 'Are you sure?',
            // text: "You won't be able to revert this!",
            // icon: 'warning',
            // showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes, delete it!'
            // }).then((result) => {
            // if (result.isConfirmed) {
            //     Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            //     )
            // }
            // })

        </script>


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


    @if (session('delete_success'))
        <script>
            Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('delete_success') }}',
            })
        </script>
    @endif




@endsection


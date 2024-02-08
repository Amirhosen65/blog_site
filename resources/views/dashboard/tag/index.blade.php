@extends('layouts.dashboard_master')


@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Tags</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                Tag List
            </div>
            <div class="card-body">
                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @forelse ($tags as $tag)

                      <tr>
                        <th scope="row">{{ $loop->index +1 }}</th>
                        <td>{{ $tag->title }}</td>
                        <td>

                            <form action="{{ route('tag.status',$tag->id) }}" method="POST">
                                @csrf
                                @if ($tag->status == 'active')
                                <button type="submit" class="btn btn-success btn-sm">Active</button>

                                @else
                                <button type="submit" class="btn btn-danger btn-sm">Dective</button>
                            @endif
                            </form>
                        </td>
                        <td>

                            <form action="{{ route('tag.delete', $tag->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>

                      </tr>

                      @empty
                      <tr>
                        <td colspan="4" class="text-center text-danger"><h3>Tag Empty!</h3></td>
                      </tr>


                      @endforelse
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                Tag Add
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('tag.insert') }}">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Tag Title</label>
                      <input type="text" class="form-control @error('title') is-invalid
                      @enderror" name="title">
                      @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                  </form>
            </div>
        </div>
    </div>
</div>


{{-- sweet alert --}}
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

        @endif

        @endsection

@endsection


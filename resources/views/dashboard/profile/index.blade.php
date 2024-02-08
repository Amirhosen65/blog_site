
@extends('layouts.dashboard_master')

@section('content')

    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Profile</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Name Update</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.name.update',auth()->id()) }}" method="POST">
                        @csrf

                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button type="submit" class="btn btn-success mt-3">Update</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Email Update</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.email.update',auth()->id()) }}" method="POST">
                        @csrf

                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        <button type="submit" class="btn btn-success mt-3" name="email_update">Update</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Change Password</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.password.update',auth()->id()) }}" method="POST">
                            @csrf

                            <label for="" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Enter Current Password">
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="Enter New Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Enter Confirm Password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <button type="submit" class="btn btn-success mt-3">Update</button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Image Update</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.image.update',auth()->id()) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <img src="{{ asset('uploads/default') }}/{{ auth()->user()->image }}" class="img-thumbnail" style="height: 250px; width: auto">
                            <input type="file" class="form-control mt-2 @error('image') is-invalid

                            @enderror" name="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <button type="submit" class="btn btn-success mt-3">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->role == 'user')
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2>Become a author?</h2>
                        </div>
                        <div class="card-body">

                            @if (auth()->user()->author_status == 'requests')
                            <p class="text-info">Request sent, waiting for approval.</p>
                                <a href="" @disabled(true) type="submit" class="btn btn-disabled btn-success mt-3">Request Sent</a>
                            @else
                                <a href="{{ route('authors.send.requests',auth()->id()) }}" type="submit" class="btn btn-success mt-3">Send Request</a>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endif

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

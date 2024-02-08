@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Add New User</h1>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="card">

            @if (auth()->user()->role == 'administrator')
            <div class="card-body">
                <form action="{{ route('user.add') }}" method="POST">
                    @csrf
                    <div class="example-content">
                        <label for="signUpUsername" class="form-label">Name</label>
                        <input type="name" class="form-control m-b-md @error('name') is-invalid @enderror" name="name" id="signUpUsername" aria-describedby="signUpUsername" placeholder="Enter Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="signUpEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control m-b-md @error('email') is-invalid @enderror" name="email" id="signUpEmail" aria-describedby="signUpEmail" placeholder="example@neptune.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="" class="mb-2">Select User Role</label>
                        <select name="role" class="form-select form-control form-control-solid-bordered m-b-sm">
                            <option  value="admin">Admin</option>
                            <option value="author">Author</option>
                            <option value="editor">Editor</option>
                            <option value="moderator">Moderator</option>
                            <option value="subscriber">Subscriber</option>
                        </select>

                        <label for="signUpPassword" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="signUpPassword" aria-describedby="signUpPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div id="emailHelp" class="form-text m-b-md">Password must be minimum 8 characters length*</div>

                        <label for="signUpPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="signUpPassword" aria-describedby="signUpPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                </form>
                </div>
                @else
                <h1>You can't access this page!</h1>
                @endif

            </div>
        </div>
</div>


@endsection

@section('footer_script')

@if (session('success'))
    <script>
        Swal.fire({
        icon: 'success',
        title: 'Great',
        text: '{{ session('success') }}',
        })
    </script>
@endif


@endsection


@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Update User Information</h1>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="card">

            @if (auth()->user()->role == 'administrator')
            <div class="card-body">
                <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="example-content">
                        <label for="signUpUsername" class="form-label">Name</label>
                        <input value="{{ $user->name }}" type="name" class="form-control m-b-md @error('name') is-invalid @enderror" name="name" id="signUpUsername" aria-describedby="signUpUsername" placeholder="Enter Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="signUpEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control m-b-md @error('email') is-invalid @enderror" name="email" id="signUpEmail" aria-describedby="signUpEmail" placeholder="example@neptune.com" value="{{ $user->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="" class="mb-2">Select User Role</label>
                        <select name="role" class="form-select form-control
                        form-control-solid-bordered m-b-sm mb-2">
                            <option value="admin" @if ($user->role === 'admin') selected @endif>Admin</option>
                            <option value="user" @if ($user->role === 'user') selected @endif>User</option>
                            <option value="author" @if ($user->role === 'author') selected @endif>Author</option>
                            <option value="editor" @if ($user->role === 'editor') selected @endif>Editor</option>
                            <option value="moderator" @if ($user->role === 'moderator') selected @endif>Moderator</option>
                            <option value="subscriber" @if ($user->role === 'subscriber') selected @endif>Subscriber</option>
                        </select>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
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



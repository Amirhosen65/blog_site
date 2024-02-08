@extends('layouts.frontend_master')

@section('content')


<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Log In</h4>
                    <!--form-->
                    <form  class="sign-form widget-form" method="POST" action="{{ route('author.login') }}">
                        @csrf


                        <div class="form-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address*" name="email" value="{{ session('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password*" name="password" value="{{ session('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }} id="rememberMe">
                                <p class="form-group"><a href="{{ route('password.request') }}" class="btn-link">Forget password?</a> </p>
                                <label class="custom-control-label" for="rememberMe">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Log In</button>
                        </div>

                    </form>
                       <!--/-->
                       <div class="form-group">
                        <a href="{{ url('/auth/google/redirect') }}" class="btn-custom">
                            <span><i class="fab fa-google mr-2"></i></span> Sign Up With Google
                        </a>
                        <a href="{{ url('/auth/github/redirect') }}" class="btn-custom">
                            <span><i class="fab fa-github mr-2"></i></span> Sign Up With GitHub
                        </a>
                    </div>
                    <p class="form-group text-center">You haven't any account? <a href="{{ route('author.register.view') }}" class="btn-link">Sing Up</a> </p>
                </div>
            </div>
         </div>
    </div>
</section>

@endsection

@section('footer_script')

{{-- alert message --}}
@if (session('success'))
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
            });
        </script>

        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Login failed!',
                text: '{{ session('error') }}',
                footer: 'Please wait for approval or <a href="{{ route('contacts') }}">contact</a> with admin.'
                })
            </script>
        @endif

@endsection



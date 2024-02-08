
@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Site Identity</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Site Title</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('site.title.update',$identy->id) }}" method="POST">
                    @csrf

                    <input type="text" class="form-control @error('site_title') is-invalid @enderror" name="site_title" value="{{ $identy->site_title }}">
                    @error('site_title')
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
                <h2>Footer</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('footer.update',$identy->id) }}" method="POST">
                    @csrf

                    <input type="text" class="form-control @error('footer') is-invalid @enderror" name="footer" value="{{ $identy->footer }}">
                    @error('footer')
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

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Header Logo</h2>
                <p>Recommended logo size 200x60px</p>
            </div>
            <div class="card-body">
                <form action="{{ route('logo.update',$identy->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="" class="form-label">Light Logo</label> <br>
                    <img src="{{ asset('uploads/logo') }}/{{ $identy->logo_white }}" style="height: 50px; width: auto; background: gray">
                    <input type="file" class="form-control mt-2 @error('logo_white') is-invalid

                    @enderror" name="logo_white">
                    @error('logo_white')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="" class="form-label mt-3">Dark Logo</label> <br>
                    <img src="{{ asset('uploads/logo') }}/{{ $identy->logo_dark }}" style="height: 50px; width: auto">
                    <input type="file" class="form-control mt-2 @error('logo_dark') is-invalid

                    @enderror" name="logo_dark">
                    @error('logo_dark')
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
                <h2>Favicon</h2>
                <p>Recommended favicon size 60x60px</p>
            </div>
            <div class="card-body">
                <form action="{{ route('favicon.update',$identy->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <img src="{{ asset('uploads/logo') }}/{{ $identy->favicon }}" style="height: 50px; width: auto">
                    <input type="file" class="form-control mt-2 @error('favicon') is-invalid

                    @enderror" name="favicon">
                    @error('favicon')
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>About</h2>

            </div>
            <div class="card-body">
                <form action="{{ route('about.update',$identy->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <h4 class="mt-2">Banner</h4>
                        <p>Recommended image size 1200x700px</p>
                        <img class="mb-2 mt-2 img-fluid" src="{{ asset('uploads/others') }}/{{ $identy->about_image }}" alt="" style="max-width: 700px">
                        <input type="file" class="form-control mt-2 @error('about_image') is-invalid @enderror" name="about_image">
                            @error('about_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                    </div>
                    <div>
                        <h4 class="mt-5">About Text</h4>
                        <textarea name="about_text" class="form-control mt-2 @error('about_text') is-invalid @enderror" id="summernote2" cols="30" rows="10">{{ $identy->about_text }}</textarea>

                            @error('about_text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn btn-success mt-3">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Contact</h2>

            </div>
            <div class="card-body">
                <form action="{{ route('contact.update',$identy->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <h4 class="mt-2">Banner</h4>
                        <p>Recommended image size 1200x700px</p>
                        <img class="mb-2 mt-2 img-fluid" src="{{ asset('uploads/others') }}/{{ $identy->contact_image }}" alt="" style="max-height: 400px">
                        <input type="file" class="form-control mt-2 @error('contact_image') is-invalid @enderror" name="contact_image">
                            @error('contact_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                    </div>
                    <div>
                        <h4 class="mt-2">Contact Text</h4>
                        <textarea name="contact_text" class="form-control mt-2 @error('contact_text') is-invalid @enderror" id="" cols="30" rows="10">{{ $identy->contact_text }}</textarea>

                            @error('contact_text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn btn-success mt-3">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

        {{-- <div class="row column1">
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">

                  <div class="full price_table padding_infor_info">
                     <div class="row">



                        {{-- About Info --}}
                        {{--<div class="col-12 col-xs-12">
                            <div class="table_price full">
                               <div class="inner_table_price">
                                  <div class="price_table_head blue1_bg">
                                     <h2>About</h2>
                                  </div>
                                  <div class="price_table_inner text-center">
                                    <form action="{{ route('about.update',$identy->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <h4 class="mt-2">Banner</h4>
                                            <img class="mb-2 mt-2 img-fluid" src="{{ asset('frontend_asset/assets/img') }}/{{ $identy->about_image }}" alt="" style="max-width: 700px">
                                            <input type="file" class="form-control mt-2 @error('about_image') is-invalid @enderror" name="about_image">
                                                @error('about_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                        </div>
                                        <div>
                                            <h4 class="mt-2">About Text</h4>
                                            <textarea name="about_text" class="form-control mt-2 @error('about_text') is-invalid @enderror" id="" cols="30" rows="10">{{ $identy->about_text }}</textarea>

                                                @error('about_text')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="price_table_bottom">
                                                    <div class="center"><button class="main_bt" >Update</button></div>
                                                </div>
                                        </div>
                                    </form>

                                  </div>
                               </div>
                            </div>
                        </div>

                        {{-- Contact page info --}}

                        {{--<div class="col-12 col-xs-12">
                            <div class="table_price full">
                               <div class="inner_table_price">
                                  <div class="price_table_head blue1_bg">
                                     <h2>Contact</h2>
                                  </div>
                                  <div class="price_table_inner text-center">
                                    <form action="{{ route('contact.update',$identy->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <h4 class="mt-2">Banner</h4>
                                            <img class="mb-2 mt-2 img-fluid" src="{{ asset('frontend_asset/assets/img') }}/{{ $identy->contact_image }}" alt="" style="max-width: 700px">
                                            <input type="file" class="form-control mt-2 @error('contact_image') is-invalid @enderror" name="contact_image">
                                                @error('contact_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                        </div>
                                        <div>
                                            <h4 class="mt-2">Contact Text</h4>
                                            <textarea name="contact_text" class="form-control mt-2 @error('contact_text') is-invalid @enderror" id="" cols="30" rows="10">{{ $identy->contact_text }}</textarea>

                                                @error('contact_text')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="price_table_bottom">
                                                    <div class="center"><button class="main_bt" >Update</button></div>
                                                </div>
                                        </div>
                                    </form>

                                  </div>
                               </div>
                            </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
        </div> --}}







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

        <script>

            $(document).ready(function() {
              $('#summernote2').summernote();
            });

            </script>

        @endsection

@endsection

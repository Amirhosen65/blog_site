@extends('layouts.frontend_master')

@section('content')

<!--about-us-->
<section class="about-us">
    <div class="container-fluid">
        <div class="about-us-area">
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="image">
                        <img src="{{ asset('uploads/others') }}/{{ $identy->about_image }}" alt="">
                    </div>

                    <div class="description">
                        <h3 >Thank you for checking out our blog website.</h3>
                        <p>
                            
                            {!! html_entity_decode($identy->about_text) !!}
                        </p>

                        <a href="{{ route('contacts') }}" class="btn-custom">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


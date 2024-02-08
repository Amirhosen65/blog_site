@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Category Edit</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Category Update
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('category.edit',$category->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control @error('title') is-invalid
                      @enderror" name="title" value="{{ $category->title }}">
                      @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                    </div>
                    <div class="mb-3">
                      <label class="form-label">Slug</label>
                      <input type="text" class="form-control" name="slug" value="{{ $category->slug }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mt-2">Image</label><br>
                        <img src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="" style="height: 200px; width: auto;">

                        <input type="file" class="form-control mt-2 @error('image') is-invalid
                        @enderror" name="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>
</div>

@endsection

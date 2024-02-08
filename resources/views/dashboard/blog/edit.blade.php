@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Blog Edit</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <form method="POST" action="{{ route('blog.edit.update',$blog->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label"><h3>Blog Title</h3></label>
                      <input type="text" class="form-control @error('title') is-invalid
                      @enderror" name="title" value="{{ $blog->title }}">
                      @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                    </div>
                    <div class="mb-3">
                      <label class="form-label"><h3>Blog Description</h3></label>
                      <textarea id="summernote2" name="description" class="form-control @error('description') is-invalid @enderror" rows="30">{{ $blog->description }}</textarea>
                      @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><h3>Blog Tags</h3></label>
                        <div>
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">

                                    <input class="form-check-input tag-checkbox" type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                    @foreach ($blog->ManyRelationTags as $s_tag)
                                    @if ($s_tag->id == $tag->id)
                                    checked
                                    @endif
                                    @endforeach
                                    >
                                    <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->title }}</label>

                                </div>
                            @endforeach
                        </div>
                        <a class="mt-2" href="{{ route('tag') }}">Create New Category</a>

                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label"><h3>Category</h3></label>

                        <select required name="category_id" class="form-select @error('category') is-invalid @enderror" aria-label="Default select example">
                            <option>Select Category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if ($blog->category_id==$category->id)
                                    selected
                                    @endif
                                    >{{ $category->title }}</option>
                            @endforeach
                          </select>

                          <a class="mt-2" href="{{ route('category') }}">Create New Category</a>

                          @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label"><h3>Image</h3></label><br>
                        <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" class="img-thumbnail" style="height: 150px; width: auto">

                        <input type="file" class="form-control" name="image">

                      </div>

                      <div class="mb-3 col-6">
                        <label class="form-label"><h3>Submit Date</h3></label>
                        <input type="date" class="form-control" name="date" value="{{ $blog->date }}">

                      </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

<script>

$(document).ready(function() {
  $('#summernote2').summernote();
});


</script>



@endsection

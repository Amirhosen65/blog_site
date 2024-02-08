@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Blogs</h1>
        </div>

            <div class="d-flex justify-content-end mb-2">
                <form action="{{ route('blog.trash') }}">
                    <button class="btn btn-warning btn-sm">
                        Blog Trash
                    </button>
                </form>
            </div>

    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        @if (auth()->user()->role == 'administrator')
                        <th scope="col">Feature</th>

                        @endif
                          </tr>
                        </thead>
                        <tbody>

                            {{-- show all blogs when user administrator --}}
                            @if (auth()->user()->role == 'administrator')

                            @forelse ($all_blogs as $all_blog)

                          <tr>
                            <th scope="row">{{ $all_blogs->firstItem() + $loop->index }}</th>
                            <td><img src="{{ asset('uploads/blog') }}/{{ $all_blog->image }}" alt="" style="height: 80px; width: auto;"></td>
                            <td>{{ $all_blog->title }}</td>
                            <td>{{ $all_blog->RelationUser->name }}</td>
                            <td>{{ $all_blog->RelationCategory->title }}</td>
                            <td>
                                <div >
                                    <form action="{{ route('blog.status',$all_blog->id) }}" method="POST">
                                        @csrf
                                        @if ($all_blog->status == 'published')
                                        <button type="submit" class="btn btn-success btn-sm">Published</button>
                                        @else
                                        <button type="submit" class="btn btn-danger btn-sm">Draft</button>
                                        @endif
                                    </form>


                                </div>
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                        <a href="{{ route('blog.edit',$all_blog->id) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                    <form action="{{ route('blog.delete',$all_blog->id) }}" method="POST">
                                        @csrf

                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </div>

                            </td>

                            @if (auth()->user()->role == 'administrator')

                            <td>
                                @if ($all_blog->feature == 'active')
                                <a href="{{ route('blog.feature',$all_blog->id) }}" class="btn btn-success btn-sm">
                                    Active
                                </a>
                                @else
                                <a href="{{ route('blog.feature',$all_blog->id) }}" class="btn btn-danger btn-sm">
                                    Deactive
                                </a>
                                @endif

                            </td>
                            @endif
                          </tr>

                          @empty
                          <tr>
                            <td colspan="8" class="text-center text-danger"><h3>Blogs Empty!</h3></td>
                          </tr>
                          @endforelse

                          @else
                          {{-- logged in user's blogs --}}

                          @forelse ($blogs as $blog)

                          <tr>
                            <th scope="row">{{ $blogs->firstItem() + $loop->index }}</th>
                            <td><img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="" style="height: 80px; width: auto;"></td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->RelationUser->name }}</td>
                            <td>{{ $blog->RelationCategory->title }}</td>
                            <td>
                                <div >
                                    <form action="{{ route('blog.status',$blog->id) }}" method="POST">
                                        @csrf
                                        @if ($blog->status == 'published')
                                        <button type="submit" class="btn btn-success btn-sm">Published</button>
                                        @else
                                        <button type="submit" class="btn btn-danger btn-sm">Draft</button>
                                        @endif
                                    </form>


                                </div>
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                        <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                    <form action="{{ route('blog.delete',$blog->id) }}" method="POST">
                                        @csrf

                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </div>

                            </td>

                            @if (auth()->user()->role == 'administrator')

                            <td>
                                @if ($blog->feature == 'active')
                                <a href="{{ route('blog.feature',$blog->id) }}" class="btn btn-success btn-sm">
                                    Active
                                </a>
                                @else
                                <a href="{{ route('blog.feature',$blog->id) }}" class="btn btn-danger btn-sm">
                                    Deactive
                                </a>
                                @endif

                            </td>
                            @endif
                          </tr>

                          @empty
                          <tr>
                            <td colspan="7" class="text-center text-danger"><h3>Blogs Empty!</h3></td>
                          </tr>
                          @endforelse
                          @endif

                        </tbody>
                      </table>

                      {{-- Pagination --}}
                      @if (auth()->user()->role == 'administrator')
                      <nav aria-label="...">
                        <ul class="pagination justify-content-end">
                          <li class="page-item {{ $all_blogs->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $all_blogs->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                          </li>

                          @for ($i = 1; $i <= $all_blogs->lastPage(); $i++)
                            <li class="page-item {{ $i == $all_blogs->currentPage() ? 'active' : '' }}">
                              <a class="page-link" href="{{ $all_blogs->url($i) }}">{{ $i }}</a>
                            </li>
                          @endfor

                          <li class="page-item {{ $all_blogs->currentPage() == $all_blogs->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $all_blogs->nextPageUrl() }}">Next</a>
                          </li>
                        </ul>
                      </nav>
                      @else
                      <nav aria-label="...">
                        <ul class="pagination justify-content-end">
                          <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $blogs->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                          </li>

                          @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                            <li class="page-item {{ $i == $blogs->currentPage() ? 'active' : '' }}">
                              <a class="page-link" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                            </li>
                          @endfor

                          <li class="page-item {{ $blogs->currentPage() == $blogs->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $blogs->nextPageUrl() }}">Next</a>
                          </li>
                        </ul>
                      </nav>
                      @endif

                </div>
            </div>
        </div>
    </div>
</div>



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


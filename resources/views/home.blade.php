
@extends('layouts.dashboard_master')

@section('content')


            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Dashboard</h1>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-primary">
                                    <i class="material-icons-outlined">post_add</i>
                                    <a href="{{ route('blog.index') }}">View</a>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Total Posts</span>
                                    <span class="widget-stats-amount">{{ $blogs->count() }}</span>
                                    <span class="widget-stats-info text-success">{{ $blogs->where('created_at', '>=', now()->subDays(7))->count() }} New Last 7 Days</span>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-primary">
                                    <i class="material-icons-outlined">pending_actions</i>
                                    <a href="#">View</a>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Pending Posts</span>
                                    <span class="widget-stats-amount">{{ $blogs->where('status','draft')->count() }}</span>
                                    <span class="widget-stats-info text-success">{{ $blogs->where('status','draft')->where('created_at', '>=', now()->subDays(7))->count() }} New Last 7 Days</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-primary">
                                    <i class="material-icons-outlined">preview</i>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Total Views</span>
                                    <span class="widget-stats-amount">{{ $blogs->sum('visitor_count') }}</span>
                                    <span class="widget-stats-info text-success">{{ $blogs->where('created_at', '>=', now()->subDays(7))->sum('visitor_count') }} New Last 7 Days</span>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                            <div class="widget-stats-container d-flex">
                                <div class="widget-stats-icon widget-stats-icon-primary">
                                    <i class="material-icons-outlined">groups</i>
                                    <a href="{{ route('users.index') }}">View</a>
                                </div>
                                <div class="widget-stats-content flex-fill">
                                    <span class="widget-stats-title">Total Users</span>
                                    <span class="widget-stats-amount">{{ $users->count() }}</span>
                                    <span class="widget-stats-info text-success">{{ $users->where('created_at', '>=', now()->subDays(7))->count() }} New Last 7 Days</span>
                                </div>

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

@endsection

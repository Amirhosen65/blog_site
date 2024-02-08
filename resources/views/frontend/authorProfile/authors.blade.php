@extends('layouts.frontend_master')

@section('content')

<!-- blog-author-->
<section class="blog-author mt-10">
    <div class="container-fluid">
        <div class="row">
<!--content-->
<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">

        <section class="authors">
            <div class="container-fluid">
                <div class="row">
                    <!--author-image-->
                    <div class="col-lg-12 col-md-12 ">
                            @forelse ($authors as $author)
                                <div class="authors-info" style="margin-top: 10px; padding: 15px 0px;">
                                <div class="image">
                                    <a href="{{ route('authors.profile', $author->id) }}" class="image">
                                        @if ($author->attempt == 'local')

                                        <img src="{{ asset('uploads/default') }}/{{ $author->image }}" style="border-radius: 50%" alt="">
                                        @else
                                        <img src="{{ $author->image }}" style="border-radius: 50%" alt="">

                                        @endif

                                    </a>
                                </div>
                                <div class="content">
                                    <h4><a href="{{ route('authors.profile', $author->id) }}">{{ $author->name }}</a></h4>
                                    <span class="badge text-bg-success" style="background-color: green; color: white; text-transform: capitalize;">{{ $author->role }}</span>

                                    <p>
                                         Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
                                        Quis sem justo nisi varius.
                                    </p>
                                    <div class="social-media">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" >
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" >
                                                    <i class="fab fa-pinterest"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h2 class="text-danger">Authors not found!</h2>
                            @endforelse
                        <!--/-->
                    </div>
                </div>
            </div>
        </section>

        <!--pagination-->
        <div class="pagination">
            <div class="pagination-area">
                <div class="pagination-list">
                    <ul class="list-inline">
                        @if ($authors->onFirstPage())
                            <li class="disabled"><a href="#"><i class="las la-arrow-left"></i></a></li>
                        @else
                            <li><a href="{{ $authors->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
                        @endif

                        @foreach ($authors->getUrlRange(1, $authors->lastPage()) as $page => $url)
                            @if ($page == $authors->currentPage())
                                <li><a href="{{ $url }}" class="active">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($authors->hasMorePages())
                            <li><a href="{{ $authors->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
                        @else
                            <li class="disabled"><a href="#"><i class="las la-arrow-right"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<!--/-->

            <!--Sidebar-->
            <div class="col-lg-4 oredoo-sidebar">
                <div class="theiaStickySidebar">
                    <div class="sidebar">
                        <!--search-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Search</h5>
                            </div>
                            <div class=" widget-search">
                                <form action="{{ route('search.blogs') }}" method="GET">
                                    <input type="search" id="gsearch" name="search_blog" placeholder="Search ....">
                                    <button class="btn-submit"><i class="las la-search"></i></button>
                                </form>
                            </div>
                         </div>

                        <!--categories-->
                        <div class="widget ">
                            <div class="widget-title">
                                <h5>Categories</h5>
                            </div>
                            <div class="widget-categories">
                                @forelse ($categories as $category)
                                    <a class="category-item" href="{{ route('category.blogs',$category->id) }}">
                                        <div class="image">
                                            <img src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="" >
                                        </div>

                                        <p>{{ $category->title }}</p>
                                    </a>
                                @empty

                                @endforelse


                            </div>
                        </div>

                         <!--newslatter-->
                         <div class="widget widget-newsletter">
                            <h5>Subscribe To OurNewsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress" required="required">
                                    </div>
                                    <button class="btn-custom" type="submit"> Subscribe now</button>
                                </div>
                            </form>
                         </div>

                         <!--stay connected-->
                         <div class="widget ">
                            <div class="widget-title">
                                <h5>Stay connected</h5>
                            </div>

                            <div class="widget-stay-connected">
                                <div class="list">
                                    <div class="item color-facebook">
                                        <a href="#"><i class="fab fa-facebook"></i></a>
                                        <p>Facebook</p>
                                    </div>

                                    <div class="item color-instagram">
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <p>instagram</p>
                                    </div>

                                    <div class="item color-twitter">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <p>twitter</p>
                                    </div>

                                    <div class="item color-youtube">
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                        <p>Youtube</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                         <!--Tags-->
                         <div class="widget">
                             <div class="widget-title">
                                 <h5>Tags</h5>
                             </div>
                             <div class="tags">
                                <ul class="list-inline">
                                    @forelse ($tags as $tag)
                                    <li>
                                        <a href="{{ route('tag.blogs',$tag->id) }}">{{ $tag->title }}</a>
                                    </li>
                                @empty
                                    <p class="text-danger">No tags found!</p>
                                @endforelse
                                </ul>
                             </div>
                         </div>

                         <!--popular-posts-->
                         <div class="widget">
                             <div class="widget-title">
                                 <h5>popular Posts</h5>
                             </div>

                             <ul class="widget-popular-posts">
                                <!--post1-->
                                <!--post1-->
                                @foreach ($popular_blogs as $blog)
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="{{ route('single.blog',$blog->id) }}">
                                            <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="" style="object-fit: cover;">
                                            <small class="nb">{{ $loop->index + 1 }}</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="{{ route('single.blog',$blog->id) }}">{{ $blog->title }}</a>
                                        </p>
                                        <small> <span class="slash"></span>{{ \Carbon\Carbon::parse($blog->date)->diffForHumans() }}</small>
                                    </div>
                                </li>
                            @endforeach
                                 <!--/-->
                             </ul>
                         </div>

                         <!--/-->
                     </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>
</section>

@endsection


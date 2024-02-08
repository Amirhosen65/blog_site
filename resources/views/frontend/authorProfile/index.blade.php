@extends('layouts.frontend_master')

@section('content')

  <!--author-->
  <section class="authors">
    <div class="container-fluid">
        <div class="row">
            <!--author-image-->
            <div class="col-lg-12 col-md-12 ">
                    <div class="authors-info">
                    <div class="image">
                        <a href="author.html" class="image">
                            <img src="{{ asset('uploads/default') }}/{{ $author->image }}" alt="">

                        </a>
                    </div>
                    <div class="content">
                        <h4 >{{ $author->name }}</h4>
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
                <!--/-->
            </div>
        </div>
    </div>
</section>

<!-- blog-author-->
<section class="blog-author mt-30">
    <div class="container-fluid">
        <div class="row">
            <!--content-->
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <!--post1-->
                    @forelse ($blogs as $blog)
                            <div class="post-list post-list-style4">
                                <div class="post-list-image">
                                    <a href="{{ route('single.blog',$blog->id) }}">
                                        <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="">
                                    </a>
                                </div>
                                <div class="post-list-content">
                                    <ul class="entry-meta">
                                        <li class="entry-cat">
                                            <a href="{{ route('category.blogs',$blog->RelationCategory->id) }}" class="category-style-1">{{ $blog->RelationCategory->title }}</a>
                                        </li>
                                        <li class="post-date"> <span class="line"></span> {{ \Carbon\Carbon::parse($blog->date)->format("M d, Y") }}</li>
                                    </ul>
                                    <h5 class="entry-title">
                                        <a href="{{ route('single.blog',$blog->id) }}">{{ $blog->title }}</a>
                                    </h5>
                                    <p><i class="lar la-eye icon-dark"></i> Views: {{ $blog->visitor_count }}</p>
                                    <div class="post-btn">
                                        <a href="{{ route('single.blog',$blog->id) }}" class="btn-read-more">Continue Reading <i
                                                class="las la-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <h1 class="text-center text-danger">No Blog Available Right Now!</h1>

                        @endforelse


                        <!--pagination-->
                        <div class="pagination">
                            <div class="pagination-area">
                                <div class="pagination-list">
                                    <ul class="list-inline">
                                        @if ($blogs->onFirstPage())
                                            <li class="disabled"><a href="#"><i class="las la-arrow-left"></i></a></li>
                                        @else
                                            <li><a href="{{ $blogs->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
                                        @endif

                                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                            @if ($page == $blogs->currentPage())
                                                <li><a href="{{ $url }}" class="active">{{ $page }}</a></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        @if ($blogs->hasMorePages())
                                            <li><a href="{{ $blogs->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
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


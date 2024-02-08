@extends('layouts.frontend_master')

@section('content')


<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">

                         @if (isset($search))
                            <h1>Search result of "{{$search}}"</h1>
                            @else
                            <h1>All Blogs</h1>
                         @endif
                         <p class="links"><a href="{{ route('root') }}">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">

                 <!--post 1-->
                 @forelse ($blogs as $blog)
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="{{ route('single.blog',$blog->id) }}">
                                <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="{{ route('single.blog',$blog->id) }}">{{ $blog->title }}</a>
                            </h3>
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{ asset('uploads/default') }}/{{ $blog->RelationUser->image }}" alt=""></li>
                                <li class="post-author"> <a href="author.html">{{ $blog->RelationUser->name }}</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{ $blog->RelationCategory->title }}</a></li>
                                <li class="post-date"> <span class="line"></span> {{ \Carbon\Carbon::parse($blog->date)->format("M d, Y") }}</li>
                            </ul>
                            <div class="post-excerpt">
                                <p>
                                    <?php
                                    $blog_des = strip_tags($blog->description);
                                    $blog_id = $blog->id;
                                    if(strlen($blog_des > 250)):
                                        $blog_cut = substr($blog_des,0,200);
                                        $endpoint = strrpos($blog_cut, " ");
                                        $blog_des = $endpoint?substr($blog_cut,0,$endpoint):substr($blog_cut,0);
                                        $blog_des .="...";
                                    endif;
                                    echo $blog_des;
                                ?>
                                </p>
                                <p><i class="lar la-eye icon-dark"></i> Views: {{ $blog->visitor_count }}</p>
                            </div>

                            <div class="post-btn">
                                <a href="{{ route('single.blog',$blog->id) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                 @empty
                 <h1 class="text-center text-danger">No Post Available Right Now!</h1>

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
     </div>
 </section>



@endsection

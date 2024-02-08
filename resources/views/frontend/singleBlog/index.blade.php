@extends('layouts.frontend_master')

@section('content')

    <!--post-single-->
    <section class="post-single">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-lg-12">
                    <!--post-single-image-->
                        <div class="post-single-image img-fluid text-center">
                            <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="">
                        </div>

                        <div class="post-single-body">
                            <!--post-single-title-->
                            <div class="post-single-title">
                                <h2>{{ $blog->title }}</h2>
                                <ul class="entry-meta">
                                    <li class="post-author-img"><img src="{{ asset('uploads/default') }}/{{ $blog->RelationUser->image }}" alt=""></li>
                                    <li class="post-author"> <a href="{{ route('authors.profile',$blog->RelationUser->id) }}">{{ $blog->RelationUser->name }}</a></li>
                                    <li class="entry-cat"> <a href="{{ route('category.blogs',$blog->RelationCategory->id) }}" class="category-style-1 "> <span class="line"></span> {{ $blog->RelationCategory->title }}</a></li>
                                    <li class="post-date"> <span class="line"></span> {{ \Carbon\Carbon::parse($blog->date)->format("M d, Y") }}</li>
                                </ul>

                            </div>

                            <!--post-single-content-->
                            <div class="post-single-content">
                                <p>
                                    {!! html_entity_decode($blog->description) !!}
                                </p>
                            </div>
                            <p><i class="lar la-eye icon-dark"></i> Views: {{ $blog->visitor_count }}</p>
                            <!--post-single-bottom-->
                            <div class="post-single-bottom">
                                <div class="tags">

                                    <p>Tags:</p>
                                    <ul class="list-inline">
                                        @forelse ($blog->ManyRelationTags as $tag)
                                            <li >
                                                <a href="{{ route('tag.blogs',$tag->id) }}">{{ $tag->title }}</a>
                                            </li>
                                        @empty
                                            <h3>No tag available for this post.</h3>
                                        @endforelse

                                    </ul>
                                </div>
                                <div class="social-media">
                                    <p>Share on :</p>
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

                            <!--post-single-author-->
                            <div class="post-single-author ">
                                <div class="authors-info">
                                    <div class="image">
                                        <a href="author.html" class="image">
                                            <img src="{{ asset('uploads/default') }}/{{ $blog->RelationUser->image }}" alt="" style="border-radius: 50%">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4><a href="{{ route('authors.profile',$blog->RelationUser->id) }}">{{ $blog->RelationUser->name }}</a></h4>
                                        <p> Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
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
                            </div>


                            <!--post-single-comments-->
                            <div class="post-single-comments">
                                <!--Comments-->
                                <h4 >{{ $comments->count() }} Comments</h4>
                                <ul class="comments">

                                    <!--comment1-->
                                   @foreach ($comments as $comment)
                                     <li class="comment-item mt-1">
                                        @if ($blog->RelationUser->id == $comment->user_id)
                                        <img src="{{ asset('uploads/default') }}/{{ $blog->RelationUser->image }}" style="border-radius: 50%" alt="">

                                        @else
                                        <img src="{{ Avatar::create($comment->name)->toBase64() }}" />
                                        @endif
                                         <div class="content">
                                             <div class="meta">
                                                 <ul class="list-inline">
                                                     <li><a href="#">{{ $comment->name }} @if ($blog->RelationUser->id == $comment->user_id)
                                                        <span class="badge text-bg-success" style="background-color: green; color: white">Author</span>
                                                     @endif</a> </li>
                                                     <li class="slash"></li>
                                                     <li>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</li>
                                                 </ul>
                                             </div>
                                             <p>{{ $comment->message }}
                                             </p>
                                             <a href="#comment" id="{{ $comment->id }}" onclick="myReply(event)" class="btn-reply get-comment-id"><i class="las la-reply"></i> Reply</a>
                                         </div>

                                     </li>

                                     {{-- Comment Reply  --}}
                                     @foreach ($comment->relationWithReply as $reply)
                                     <li class="comment-item mt-1" style="margin-left: 12%">
                                        @if ($blog->RelationUser->id == $reply->user_id)
                                            <img src="{{ asset('uploads/default') }}/{{ $blog->RelationUser->image }}" style="border-radius: 50%" alt="">

                                            @else
                                            <img src="{{ Avatar::create($reply->name)->toBase64() }}" />
                                            @endif
                                        <div class="content">
                                            <div class="meta">
                                                <ul class="list-inline">
                                                    <li><a href="#">{{ $reply->name }} @if ($blog->RelationUser->id == $reply->user_id)
                                                       <span class="badge text-bg-success" style="background-color: green; color: white">Author</span>
                                                    @endif</a> </li>
                                                    <li class="slash"></li>
                                                    <li>{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</li>
                                                </ul>
                                            </div>
                                            <p>{{ $reply->message }}
                                            </p>
                                            <a href="#comment" id="{{ $reply->id }}" onclick="myReply(event)" class="btn-reply get-comment-id"><i class="las la-reply"></i> Reply</a>
                                        </div>

                                    </li>

                                        {{-- Reply to reply --}}
                                        @foreach ($reply->relationWithReply as $replyto)
                                        <li class="comment-item mt-1" style="margin-left: 20%">
                                            @if ($blog->RelationUser->id == $replyto->user_id)
                                            <img src="{{ asset('uploads/default') }}/{{ $blog->RelationUser->image }}" style="border-radius: 50%" alt="">

                                            @else
                                            <img src="{{ Avatar::create($replyto->name)->toBase64() }}" />
                                            @endif
                                            <div class="content">
                                                <div class="meta">
                                                    <ul class="list-inline">
                                                        <li><a href="#">{{ $replyto->name }} @if ($blog->RelationUser->id == $replyto->user_id)
                                                           <span class="badge text-bg-success" style="background-color: green; color: white">Author</span>
                                                        @endif</a> </li>
                                                        <li class="slash"></li>
                                                        <li>{{ \Carbon\Carbon::parse($replyto->created_at)->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                                <p>{{ $replyto->message }}
                                                </p>
                                                {{-- <a href="#comment" id="{{ $reply->id }}" onclick="myReply(event)" class="btn-reply get-comment-id"><i class="las la-reply"></i> Reply</a> --}}
                                            </div>

                                        </li>
                                        @endforeach

                                     @endforeach

                                   @endforeach


                                </ul>
                                <!--Leave-comments-->
                                <div class="comments-form" id="comment">
                                    <h4 >Leave a Comment</h4>
                                    <!--form-->
                                    <form class="form " action="{{ route('blog.comment') }}" method="POST" id="main_contact_form">
                                        @csrf
                                        @auth
                                        <p>You are logged in as: <b>{{ auth()->user()->name }}</b></p>
                                        @else
                                            <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                        @endauth
                                        @if (session('success'))
                                            <div class="alert alert-success contact_msg"  role="alert">
                                                Your comment has been submited successfully.
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" value="{{ $blog->id }}" name="blog_id" id="">
                                                    <input type="hidden" class="push-id" value="" name="parent_id" id="">
                                                    <input type="text" @auth hidden
                                                        value="{{ auth()->user()->name }}"
                                                    @endauth name="name" id="name" class="form-control @error('password') is-invalid @enderror" placeholder="Name*">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" @auth hidden
                                                        value="{{ auth()->user()->email }}"
                                                    @endauth name="email" id="email" class="form-control @error('password') is-invalid @enderror" placeholder="Email*" >
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" id="message" cols="30" rows="5" class="form-control @error('password') is-invalid @enderror" placeholder="Message*"></textarea>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-12">


                                                <button type="submit" class="btn-custom">
                                                    Send Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/-->
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footer_script')

<script>
    let getCommentId = document.querySelector('.get-comment-id')
    let inputPush = document.querySelector('.push-id')

    function myReply(event){
        inputPush.value = event.target.getAttribute('id')
    }

</script>


@endsection


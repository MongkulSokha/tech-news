@extends('front.layout.master')
@section('content')
    <section id="entity_section" class="entity_section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="entity_wrapper">
                        <div class="entity_title">
                            <h1><a href="{{ url('/details') }}/{{ $post->slug }}">{{ $post->title }} </a></h1>
                        </div>
                        <!-- entity_title -->

                        <div class="entity_meta"><a href="#"
                                target="_self">{{ date('F j-Y', strtotime($post->created_at)) }}</a>, by: <a
                                href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator['name'] }}</a>
                        </div>
                        <br>

                        <div class="entity_thumb">
                            <img class="img-responsive" src="{{ asset('post') }}/{{ $post->main_image }} "
                                alt="feature-top">
                        </div>
                        <!-- entity_thumb -->

                        <div class="entity_content">
                            <p style="font-size:1.7rem; line-height: 1.6; text-align: justify;">
                                {!! $post->short_description !!}
                            </p>
                            <p style="font-size:1.7rem; line-height: 1.6; text-align: justify; white-space: pre-line;">
                                {!! $post->description !!}
                            </p>
                        </div>

                        <!-- entity_content -->

                        <div class="entity_footer">

                            <!-- entity_tag -->

                            <div class="entity_social">
                                <span><a href="#"><i
                                            class="fa fa-comments-o"></i>{{ count($post->comments) }}</a>Comments</span>
                                <span><a href="#">{{ $post->view_count }}</a>Views</span>
                            </div>
                            <!-- entity_social -->

                        </div>
                        <!-- entity_footer -->

                    </div>
                    <!-- entity_wrapper -->

                    <div class="related_news">
                        <div class="entity_inner__title header_purple">
                            <h2><a href="#">Related News</a></h2>
                        </div>
                        <!-- entity_title -->

                        <div class="row">
                            @foreach ($related_news as $news)
                                <div class="col-md-6">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="{{ url('/details') }}/{{ $news->slug }}"><img class="media-object"
                                                    src="{{ asset('post') }}/{{ $news->thumb_image }} "
                                                    alt="{{ $news->title }}"></a>
                                        </div>
                                        <div class="media-body">
                                            <span class="tag purple"><a
                                                    href="{{ url('/category') }}/{{ $news->category_id }}">{{ $news->category['name'] }}</a>
                                            </span>

                                            <h3 class="media-heading" style="margin-top: 5%"><a
                                                    href="{{ url('/details') }}/{{ $news->slug }}">{{ Str::limit($news->title, 65, '...') }}</a>
                                            </h3>

                                            <span class="media-date">
                                                <a href="#"
                                                    target="_self">{{ date('F j-Y', strtotime($news->created_at)) }}</a>,
                                                by:
                                                <a href="{{ url('/author') }}/{{ $news->creator->id }}">
                                                    {{ $news->creator['name'] }}
                                                </a></span>

                                            <div class="media_social" style="margin-top:4%">
                                                <span><a href="#"><i
                                                            class="fa fa-comments-o"></i>{{ count($news->comments) }}</a>
                                                    Comments</span>
                                                <span><a href="#">{{ $news->view_count }}</a> Views</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Related news -->

                    <div class="widget_advertisement">
                        <img class="img-responsive" src="{{ asset('front/img/category_advertisement.jpg') }} "
                            alt="feature-top">
                    </div>
                    <!--Advertisement-->

                    <div class="readers_comment">
                        <div class="entity_inner__title header_purple">
                            <h2>Readers Comment</h2>
                        </div>
                        <!-- entity_title -->
                        @foreach ($post->comments as $comment)
                            @if ($comment->status === 1)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img alt="64x64" width="64" height="64" class="media-object"
                                                data-src="{{ asset('others/user.png ') }} "
                                                src="{{ asset('others/user.png ') }} " data-holder-rendered="true">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="media-heading"><a href="#">{{ $comment->name }}</a></h2>
                                        <p style="font-size:1.5rem">{{ $comment->comment }}</p>
                                    </div>

                                </div>
                                <!-- media end -->
                            @endif
                        @endforeach
                        <!-- media end -->
                    </div>
                    <!--Readers Comment-->

                    <div class="widget_advertisement">
                        <img class="img-responsive" src="{{ asset('front/img/category_advertisement.jpg') }} "
                            alt="feature-top">
                    </div>
                    <!--Advertisement-->

                    @auth
                    <div class="entity_comments">
                        <div class="entity_inner__title header_black">
                            <h2>Add a Comment</h2>
                        </div>
                        <!--Entity Title -->
                        <div class="entity_comment_from">

                            {{ Form::open(['url' => '/comments', 'method' => 'post']) }}

                            {{ Form::hidden('slug', $post->slug) }}
                            {{ Form::hidden('post_id', $post->id) }}
                            <div class="form-group">
                                {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) }}
                            </div>

                            <div class="form-group comment">
                                {{ Form::textarea('comment', null, ['class' => 'form-control', 'id' => 'comment', 'placeholder' => 'Comment']) }}
                            </div>

                            <button type="submit" class="btn btn-submit red">Submit</button>
                            {{ Form::close() }}
                        </div>
                        <!--Entity Comments From -->
                    </div>
                    @endauth
                    <!--Entity Comments -->
                </div>
                <!--Left Section-->

                <div class="col-md-4">
                    <div class="widget">
                        <div class="widget_title widget_black">
                            <h2><a href="#">Popular News</a></h2>
                        </div>
                        @foreach ($shareData['most_viewed'] as $item)
                            <div class="media">
                                <div class="media-left">
                                    <a href="{{ url('/details') }}/{{ $item->slug }}">
                                        <img class="media-object" src="{{ asset('post') }}/{{ $item->thumb_image }}"
                                            alt="{{ $item->title }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">
                                        <a
                                            href="{{ url('/details') }}/{{ $item->slug }}">{{ Str::limit($item->title, 90, '...') }}</a>
                                    </h3> <span class="media-date"><a
                                            href="#">{{ date('j F - Y', strtotime($item->created_at)) }}</a>, by: <a
                                            href="{{ url('/author') }}/{{ $item->creator->id }}">{{ $item->creator->name }}</a></span>

                                    <div class="widget_article_social">
                                        <span>
                                            <a href="single.html" target="_self"><i
                                                    class="fa fa-comments-o"></i>{{ count($item->comments) }}</a> Comments
                                        </span>
                                        <span><a href="#">{{ $item->view_count }}</a> Views</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&raquo;</a></p>
                    </div>

                    <div class="widget m30">
                        <div class="widget_title widget_black">
                            <h2><a href="#">Most Commented</a></h2>
                        </div>
                        @foreach ($shareData['most_commented'] as $item)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#"><img class="media-object"
                                            src="{{ asset('post') }}/{{ $item->thumb_image }}"
                                            alt="{{ $item->title }}"></a>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">
                                        <a href="{{ url('/details') }}/{{ $item->slug }}"
                                            target="_self">{{ Str::limit($item->title, 90, '...') }}</a>
                                    </h3>

                                    <span class="media-date">
                                        <a href="#">{{ date('j F -y', strtotime($item->created_at)) }}</a>, by:
                                        <a href="{{ url('/author') }}/{{ $item->creator->id }}">
                                            {{ $item->creator->name }}
                                        </a>
                                    </span>

                                    <div class="widget_article_social">
                                        <span> <a href="#"><i
                                                    class="fa fa-comments-o"></i>{{ count($item->comments) }}</a>
                                            Comments</span>
                                        <span><a href="#">{{ $item->view_count }}</a> Views</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&nbsp;&raquo; </a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

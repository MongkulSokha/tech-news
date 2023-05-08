@extends('front.layout.master')
@section('content')
<section class="breadcrumb_section">
    <div class="container">
        <div class="row">

        </div>
    </div>
</section>


<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach($searchPost as $key=>$post)
            @if($key === 0)
            <div class="entity_wrapper">
                <div class="entity_title header_purple">
                    <h1><a href="{{ url('/category') }}/{{ $post->category_id }}">Search Result</a></h1>
                </div>
                <!-- entity_title -->
                <div class="entity_thumb">
                    <img class="img-responsive" src="{{ asset('post') }}/{{ $post->main_image }}"
                        alt="{{ $post->title }}">
                </div>
                <!-- entity_thumb -->
                <div class="entity_title">
                    <h5>
                        <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self">{{ $post->title }} </a>
                    </h5>
                </div>
                <!-- entity_title -->
                <div class="entity_meta">
                    <a href="#">{{ date('F j-Y',strtotime($post->created_at)) }}</a>, by: <a
                        href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator->name }} </a>
                </div>
                <!-- entity_meta -->
                <div class="category_article_content">
                    {{ Str::limit( $post->short_description,200,'...' )  }}
                </div>
                <!-- entity_content -->
                <div class="entity_social">
                    <span> <a href="#"><i class="fa fa-comments-o"></i>{{ count($post->comments) }}</a>Comments </span>
                    <span><a href="#">{{ $post->view_count }}</a>Views</span>
                </div>
                <!-- entity_social -->
            </div>
            @else
            <!-- entity_wrapper -->
            @if($key === 1)
            <div class="row">
                @endif
                <div class="col-md-6" style="min-height: 555px;margin-bottom:2%">
                    <div class="category_article_body">
                        <div class="top_article_img">
                            <img class="img-fluid" src="{{ asset('post') }}/{{ $post->list_image }}"
                                alt="{{ $post->title }}">
                        </div>
                        <!-- top_article_img -->
                        <div class="category_article_title">
                            <h5>
                                <a href="{{ url('/details') }}/{{ $post->slug }}" target="_blank">
                                    {{ Str::limit( $post->title,70,'...' )  }} </a>
                            </h5>
                        </div>
                        <!-- category_article_title -->
                        <div class="article_date">
                            <a href="#">{{ date('F j-Y',strtotime($post->created_at)) }}</a>, by: <a
                                href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator->name }} </a>
                        </div>
                        <!-- article_date -->
                        <div class="category_article_content">
                            {{ Str::limit( $post->short_description,100,'...' )  }}
                        </div>
                        <!-- category_article_content -->
                        <div class="article_social">
                            <span> <a href="#"><i class="fa fa-comments-o"></i>{{ count($post->comments) }}</a>Comments </span>
                            <span><a href="#">{{ $post->view_count }}</a> Views</span>
                        </div>
                        <!-- article_social -->
                    </div>
                    <!-- category_article_body -->
                </div>
                <!-- col-md-6 -->
                @if($loop->last)
            </div>
            @endif
            @endif
            @endforeach

            <div style="margin-left: 40%">
                {{ $searchPost->links() }}
            </div>

            <!-- navigation -->
        </div>
        <!-- col-md-8 -->
        <div class="col-md-4">
            <div class="widget">
                <div class="widget_title widget_black">
                    <h2><a href="#">Popular News</a></h2>
                </div>
                @foreach($shareData['most_viewed'] as $item)
                <div class="media">
                    <div class="media-left">
                        <a href="{{ url('/details') }}/{{ $item->slug }}">
                            <img class="media-object" src="{{ asset('post') }}/{{ $item->thumb_image }}"
                                alt="{{ $item->title }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="{{ url('/details') }}/{{ $item->slug }}">{{ Str::limit( $item->title,90,'...' )  }}</a>
                        </h3> <span class="media-date"><a
                                href="#">{{ date( 'j F - Y',strtotime($item->created_at)) }}</a>, by: <a
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
                @foreach($shareData['most_commented'] as $item)
                <div class="media">
                    <div class="media-left">
                        <a href="#"><img class="media-object" src="{{asset('post')}}/{{ $item->thumb_image }}"
                                alt="{{ $item->title }}"></a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="{{ url('/details') }}/{{ $item->slug }}" target="_self">{{ Str::limit( $item->title,90,'...' )  }}</a>
                        </h3>

                        <span class="media-date">
                                <a href="#">{{ date('j F -y',strtotime($item->created_at))}}</a>, by:
                                <a href="{{ url('/author') }}/{{ $item->creator->id }}">
                                    {{$item->creator->name}}
                                </a>
                        </span>

                        <div class="widget_article_social">
                            <span> <a href="#"><i class="fa fa-comments-o"></i>{{ count($item->comments) }}</a> Comments</span>
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

@endsection

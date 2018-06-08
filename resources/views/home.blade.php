@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!--首页路径-->
        <div class="warp-breadcrumb">
            <ul class="breadcrumb">
                <li>
                    <a href="/">{{ config('app.name', 'laravel') }}</a>
                </li>
                <li  href="/home" class="active">首页</li>
            </ul>
        </div>
        <div class="main-content-area">
            <div class="container post-listing">
                <div class="row is-flex">
                    @if(!empty($articleList))
                        @foreach($articleList as $article)
                    <div class="col-sm-6 col-md-4 col-xs-12">
                        <article class="post post-card">
                            @if(!empty($article->img))
                            <a class="permalink" href="{{route('article_show',array('id'=>$article->id))}}">
                                <div class="featured-image"><img src="{{$article->img}}"/></div>
                            </a>
                            @endif
                            <div class="content-warp">
                                <div class="entry-header align-center">
                                    <span class="category"><a href="{{route('article_list',array('id'=>$article->classification_id))}}">{{$article->classification_name}}</a></span>
                                    <h2 class="title h4"><a href="{{route('article_show',array('id'=>$article->id))}}">{{$article->title}}</a></h2>
                                </div>
                                <div class="entry-footer clearfix">
                                    <div class="panel-heading">
                                    <div class="left">
                                    <span class="title_span"><time style="color: #a4aaae;" class="fa fa-calendar date" datetime="{{$article->created_at->format('C')}}" itemprop="datePublished" pubdate="">&nbsp;{!!$article->created_at->format('d F,Y')!!}</time></span>
                                    <span>|</span>
                                    <a href="##" class="author_a">{{$article->author}}</a>
                                    </div>
                                    <a href="##" class="comments_span">{{$article->comments_number}}&nbsp;评论</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                        @endforeach
                        @endif
        </div>
        <div class="pagination_item">
        {{$articleList->links()}}
        </div>
    </div>
    <div class="clear"></div>
</div>
    </div>
</div>
@endsection

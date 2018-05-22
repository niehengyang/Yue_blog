@extends('layouts.app')
<!-- Styles -->
<link href="{{asset('css/classificationlist.css')}}" rel="stylesheet">
<link href="{{asset('css/home.css')}}" rel="stylesheet">
<style>
</style>
<script type="text/javascript">

</script>
@section('content')
    <div class="container">
        <div class="row">
            <!--首页路径-->
            <div class="warp-breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <a href="/">Yue_blog</a>
                    </li>
                    <li><a href="/home">首页</a></li>
                    <li><a href="/classification/show">分类列表</a></li>
                    <li class="active">文章列表</li>
                </ul>
            </div>

            <!--文章列表-->
                <div class="col-md-8 col-md-offset-2">
                    @if(!empty($articleList))
                        @foreach($articleList as $article)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-heading left">
                                        <span class="title_span"><time style="color: #a4aaae;" class="fa fa-calendar date" datetime="{{$article->created_at->format('C')}}" itemprop="datePublished" pubdate="">&nbsp;{!!$article->created_at->format('d F,Y')!!}</time></span>
                                        <span>|</span>
                                        <a href="##" class="author_a">{{$article->author}}</a>
                                    </div>
                                    <a href="##" class="comments_span">{{$article->comments_number}}&nbsp;评论</a>
                                </div>

                                <div class="panel-body">
                                    <div class="title_item">
                                        <san><h3>{{$article->title}}</h3></san>
                                    </div>
                                    <div class="abstract_item">
                                        <span>{!! $article->abstract !!}<a href="{{route('article_show',array('id'=>$article->id))}}">查看全文</a></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="panel panel-default">
                            没有文章
                        </div>
                    @endif
                </div>
                {{--<div class="pagination_item">--}}
                    {{--{{$articleList->links()}}--}}
                {{--</div>--}}
            </div>
            <div class="clear"></div>
        </div>
    </div>
 @endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading left">
                        <span class="title_span">2018-05-10</span>
                        <span>|</span>
                        <a href="##" class="author_a">NHY</a>
                    </div>
                    <a href="##" class="comments_span">1 评论</a>
                </div>

                <div class="panel-body">
                    <div class="title_item">
                        <san><h3>这是测试标题</h3></san>
                    </div>
                    <div class="describe_item">
                        <span>这里是测试标题文章的摘要顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶...<a href="##">查看全文</a></span>
                    </div>
                </div>
            </div>
            @if(!empty($articleList))
                @foreach($articleList as $article)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-heading left">
                                <span class="title_span">{{mb_substr($article->created_at,0,10)}}</span>
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
            @endif
        </div>
        <div class="pagination_item">
        {{$articleList->links()}}
        </div>
    </div>
</div>
@endsection

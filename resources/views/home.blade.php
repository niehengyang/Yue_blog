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
                    <a href="##" class="comments_span">1 comments</a>
                </div>

                <div class="panel-body">
                    <div class="title_item">
                        <san><h3>标题一</h3></san>
                    </div>
                    <div class="describe_item">
                        <span>这里是标题一文章的摘要顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶顶...<a href="##">查看全文</a></span>
                    </div>
                </div>
            </div>
            @if(!empty($articleList))
                @foreach($articleList['data'] as $article)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-heading left">
                                <span class="title_span">{{$article->created_at}}</span>
                                <span>|</span>
                                <a href="##" class="author_a">{{$article->nickname}}</a>
                            </div>
                            <a href="##" class="comments_span">{{$article->comments_number}}</a>
                        </div>

                        <div class="panel-body">
                            <div class="title_item">
                                <san><h3>{{$article->title}}</h3></san>
                            </div>
                            <div class="describe_item">
                                <span>{{$article->describe}}<a href="##">查看全文</a></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

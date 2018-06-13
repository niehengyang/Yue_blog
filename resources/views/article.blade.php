@extends('layouts.app')
    <!-- Styles -->
    <link href="{{asset('css/article.css')}}" rel="stylesheet">
    <style>
        .warp_mid{
            width: 100%;
        }
        .gtco-cover{
            background: url("{{$article->img}}");
        }

    </style>
<script type="text/javascript">

</script>
@section('content')
    <!--header-->
    <header id="gtco-header" class="gtco-cover" role="banner" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <span class="data-post"></span>
                            <h1 class="mb30">
                                <a href="#">{{$article->title}}</a>
                            </h1>
                            <p>
                                <a href="#" class="text-link" style="font-family: '叶根友毛笔行书2.0版'">【{{$article->author}}】</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mouse-icon margin-20">
                <div class="scroll"></div>
            </div>
        </div>
    </header>

<div class="page">
    <!--首页路径-->
    {{--<div class="warp-breadcrumb">--}}
    {{--<ul class="breadcrumb">--}}
        {{--<li>--}}
            {{--<a href="/">{{ config('app.name', 'laravel') }}</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="/home">首页</a>--}}
        {{--</li>--}}
        {{--<li class="active">文章详情</li>--}}
    {{--</ul>--}}
    {{--</div>--}}

    <!---文章页面-->
@if(!empty($article))
<div class="el-row warp_mid" type="flex" justify="center">
    <div class="el-col warp_main" :span="18" :offset="6">
        {{--@if($article->img)--}}
        {{--<div class="img-item">--}}
            {{--<img src="{{$article->img}}" alt=""/>--}}
            {{--<div class="clear"></div>--}}
        {{--</div>--}}
        {{--@endif--}}
        <div class="show_box">
            <div class="main">
                <div class="header">
                    <span style="font-size: 30px;font-weight: bold" >{!!$article->title!!}</span>
                </div>
                <div class="articleinfo_cade" >
                    <time style="color: #a4aaae;" class="fa fa-calendar date" datetime="{{$article->created_at->format('C')}}" itemprop="datePublished" pubdate="">&nbsp;{!!$article->created_at->format('d F,Y')!!}</time>
                    <span style="color: #a4aaae;">&nbsp;·&nbsp;</span>
                    {{--<div class="dian_style"></div>--}}
                    <span>{{$article->classification_name}}</span>
                </div>
                <div class="content_item" >
                    <span class="content_style" alt="">{!!$article->content!!}</span>
                </div>
                <div class="author_item" style="margin-top: 10px; padding-bottom: 20px; border-bottom: 1px solid #e3e3e3;">
                    <span style="font-weight: bold; font-family: 仿宋;font-size: 2px;">发布：</span>
                    <span class="author" style="color: #a4aaae;font-size: 3px;">{{$article->author}}</span>
                </div>
            </div>
            {{--<div class="footer_btn">--}}
                {{--<el-button class="callback_btn" size="small" style="margin-top: 10px;" onClick="history.go(-1);">返回</el-button>--}}
            {{--</div>--}}
            <div class="clear"></div>
        </div>
    </div>
    @endif
</div>
        <!--tools_bar-->
    <div class="tools_bar">
        <div class="tools_item">
            @if(!empty($prev_id))
                <button class="pre_item">
                    <a href="{{route('article_show',array('id'=>$prev_id))}}" class="pre_article">上一篇：{!!$prev_article_title!!}</a>
                    <span class="aticle_name"></span>
                </button>
                @else
                    <button class="pre_item">
                        <a class="pre_article">没有了</a>
                        <span class="aticle_name"></span>
                    </button>
                @endif
            @if(!empty($next_id))
                <button class="pre_item">
                    <a href="{{route('article_show',array('id'=>$next_id))}}" class="nex_article">下一篇：{!!$next_article_title!!}</a>
                    <span class="aticle_name"></span>
                </button>
                @else
                    <button class="pre_item">
                        <a class="pre_article">没有了</a>
                        <span class="aticle_name"></span>
                    </button>
                @endif
        </div>
        <div class="clear"></div>
    </div>

    <div class="line"></div>
    <!--comments-->
    <div class="warp_comments">
        <div class="comments_item">
            <a name="comment-input" class="auchor" href="#comment-input">评论区</a>

            <div class="comment-input">
                {!! Form::open(['route' => 'comments_store','method' => 'POST']) !!}
                <input type="hidden" name="article_id" value="{{$article->id}}"/>
                @if(!empty($currentUser))
                <input type="hidden" name="user_id" value="{{$currentUser->id}}"/>
                @endif
                <input type="hidden" class="reply_parentId" name="parent_id" value="" />
                @if(empty($currentUser))
                    <div class="form-group">
                    {!! Form::email('email',null,['class' =>'form-control','row' => 3,'placeholder' => '请输入邮箱','required'=> "required"]) !!}
                    </div>
                    @else
                    <input type="hidden" name="email" value="{{$currentUser->email}}"/>
                @endif
                @if($errors->has('email'))
                    <span class="help-block">
                        <strong>{{$errors->first('email')}}</strong>
                    </span>
                @endif
                <div class="form-group">
                    {!! Form::textarea('comment_content',null,['class' => 'form-control',
                                'id'=> 'comment_textarea','rows' => 3,'placeholder' => '用心评论,文明发言!','required'=> "required"]) !!}
                </div>
                @if($errors->has('comment_content'))
                    <span class="help-block">
                        <strong>{{$errors->first('comment_content')}}</strong>
                    </span>
                @endif
                <div class="form-group status-post-submit">
                    <p class="text-right">{!! Form::submit('提交评论',['class'=>'btn btn-primary btn-xs','id'=>'reply-create-submit']) !!}</p>
                </div>
                {!! Form::close() !!}
            </div>
    </div>

        <div class="show_comments">
            <div class="comments_list">
                <p class="small">全部评论</p>
                <div class="show_box">
                    @if(!empty($comments[0]))
                        @foreach($comments as $comment)
                            @if($comment->release_size)
                        <div class="comment_item">
                            @if($comment->parent_id)
                                    <div class="show_nickname"><span><b>{{$comment->nickname}}</b>&nbsp;回复<b>&nbsp;{{$comment->parent_nickname}}</b></span></div>
                                @else
                                    <div class="show_nickname"><span><b>{{$comment->nickname}}</b></span></div>
                                @endif
                                    <div class="reply_item">
                                    <time style="color: #a4aaae;" datetime="{{$comment->created_at->format('C')}}" itemprop="datePublished" pubdate="">{{$comment->created_at->format('d F,Y')}} @ {{mb_substr($comment->created_at,10)}}</time>
                                    <span>&nbsp;/&nbsp;</span>
                                    <a href="javascript:;" class="reply_btn" data-replyuser="{{$currentUser}}" data-commentuser="{{$comment->nickname}}" data-commentId="{{$comment->user_id}}" rel="">回复</a>
                                        @if(!empty($currentUser) && ($currentUser->id == $comment->user_id))
                                        <div class="pull-right meta">
                                        <a href="{{route('comments_destroy',array('id'=>$comment->id))}}" data-method="delete"><i class="fa fa-trash">删除</i></a>
                                        </div>
                                    @endif
                                </div>
                            <div id="pointer" class="comment_content"><p class="small">{{$comment->comment_content}}</p></div>
                        </div>
                            @endif
                        @endforeach
                    @else
                        <div class="comment_content"><p class="small">暂无评论</p></div>
                    @endif
                </div>
            </div>
            <div class="row">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.poptrox.min.js')}}"></script>
@endsection
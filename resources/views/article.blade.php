@extends('layouts.app')
    <!-- Styles -->
    <link href="{{asset('css/article.css')}}" rel="stylesheet">
    <style>
        .warp_mid{
            width: 100%;
        }
    </style>
<script type="text/javascript">

</script>
@section('content')
<!---文章页面-->
<div class="page">
@if(!empty($article))
<el-row class="warp_mid" type="flex" justify="center">
    <el-col class="warp_main" :span="18" :offset="6">
        @if($article->img)
        <div class="img-item">
            <img style="width: 100%;" src="{{$article->img}}" alt=""/>
            <div class="clear"></div>
        </div>
        @endif
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
    </el-col>
    @endif
</el-row>
        <!--tools_bar-->
    <div class="tools_bar">
        <div class="tools_item">
            @if(!empty($prev_id))
                <div class="pre_item">
                    <a href="{{route('article_show',array('id'=>$prev_id))}}" class="pre_article">上一篇：{!!$prev_article_title!!}</a>
                    <span class="aticle_name"></span>
                </div>
                @else
                    <div class="pre_item">
                        <a class="pre_article">没有了</a>
                        <span class="aticle_name"></span>
                    </div>
                @endif
            @if(!empty($next_id))
                <div class="nex_item">
                    <a href="{{route('article_show',array('id'=>$next_id))}}" class="nex_article">下一篇：{!!$next_article_title!!}</a>
                    <span class="aticle_name"></span>
                </div>
                @else
                    <div class="pre_item">
                        <a class="pre_article">没有了</a>
                        <span class="aticle_name"></span>
                    </div>
                @endif
        </div>
        <div class="clear"></div>
    </div>

    <!--comments-->
    <div class="warp_comments">
        <div class="comments_item">
            <a name="comment-input" class="auchor" href="#comment-input">评论区</a>
            <textarea id="comment_text" class="form-control" rows="3" placeholder="用心评论,文明发言!"></textarea>
            <p class="text-right"><button id="comment_sub" type="button" class="btn btn-primary btn-xs">提交评论</button></p>


            {{--<div class="comment-input">--}}
                {{--{{Form::open(['route'=>'coments_store','method'=>'post'])}}--}}
                {{--<input type="hidden" name="post_id" value="{{$article->id}}"/>--}}
                {{--<div class="form-group">--}}
                    {{--@if($currentUser)--}}
                        {{--{{Form::textarea('body',null,['class' =>'form-control',--}}
                            {{--'rows'=>5,--}}
                            {{--'placeholder'=>land('leave a comment?'),--}}
                            {{--'style'=>'overflow:hidden',--}}
                            {{--'id'=>'reply_content'])}}--}}
                    {{--@else--}}
                        {{--{{Form::textarea('body',null,['class'=>'form-control','rows'=>5, 'placeholder'=>land('用心评论,文明发言!')])}}--}}
                    {{--@endif--}}

                {{--</div>--}}
                {{--<div class="form-group status-post-submit">--}}
                    {{--<p class="text-right">{{Form::submit(lang('Comment'),['class'=>'btn btn-primary btn-xs'.($currentUser ? '':'disabled'),'id'=>'reply-create-submit'])}}</p>--}}

                {{--</div>--}}
            {{--{{Form::close()}}--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="show_comments">
            <div class="comments_list">
                <p class="small">全部评论</p>
                <div class="show_box">
                    <div class="comment_item">
                        <div class="show_nickname"><span><b>John Doe</b></span></div>
                        <div class="reply_item">
                            <time style="color: #a4aaae;" datetime="" itemprop="datePublished" pubdate="">Jul 12,2016 @ 24:05</time>
                            <span>&nbsp;/&nbsp;</span>
                            <a href="">回复</a>
                        </div>
                        <div class="comment_content"><p class="small">评论测试1，这是评论的内容！！！！</p></div>
                    </div>
                    <div class="comment_item">
                        <div class="show_nickname"><span><b>John Doe</b></span></div>
                        <div class="reply_item">
                            <time style="color: #a4aaae;" datetime="" itemprop="datePublished" pubdate="">Jul 12,2016 @ 24:05</time>
                            <span>&nbsp;/&nbsp;</span>
                            <a href="">回复</a>
                        </div>
                        <div class="comment_content"><p class="small">评论测试2，这是评论的内容！！！！</p></div>
                        <div class="clear"></div>
                    </div>
                    {{--@if(!empty($article->comments->comment_content))--}}
                        {{--@foreach($article->comments as $comment)--}}
                    {{--<div class="comment_item">--}}
                    {{--<div class="show_nickname"><span><b>John Doe</b></span></div>--}}
                            {{--<div class="reply_item">--}}
                                {{--<time style="color: #a4aaae;" datetime="" itemprop="datePublished" pubdate="">Jul 12,2016 @ 24:05</time>--}}
                                {{--<span>&nbsp;/&nbsp;</span>--}}
                                {{--<a href="">回复</a>--}}
                            {{--</div>--}}
                            {{--<div class="comment_content"><p class="small">评论测试1，这是评论的内容！！！！</p></div>--}}
                    {{--</div>--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--<div class="comment_content"><p class="small">暂无评论</p></div>--}}
                    {{--@endif--}}
                </div>
            </div>
        </div>
    </div>


</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.poptrox.min.js')}}"></script>
@endsection
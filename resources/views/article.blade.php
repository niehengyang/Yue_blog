@extends('layouts.app')
    <!-- Styles -->
    <link href="{{asset('css/article.css')}}" rel="stylesheet">
    <style>
        .warp_mid{
            width: 100%;
        }
    </style>
@section('content')
<!---文章页面-->
<div class="page">
@if(!empty($article))
<el-row class="warp_mid" type="flex" justify="center">
    <el-col class="warp_main" :span="18" :offset="6">
        @if($article->img)
        <div class="img-item">
            <img style="width: 100%;" src="{{$article->img}}" alt=""/>
        </div>
        @endif
        <div class="show_box">
            <div class="main">
                <div class="header">
                    <span style="font-size: 30px;font-weight: bold" >{!! $article->title !!}</span>
                </div>
                <div class="articleinfo_cade" >
                    <span style="color: #a4aaae;" class="fa fa-calendar date" >{{$article->created_at}}</span>
                    <span style="color: #a4aaae;">&nbsp;·&nbsp;</span>
                    <span>{{$article->classification_name}}</span>
                </div>
                <div class="content_item" >
                    <span class="content_style" alt="">{!! $article->content !!}</span>
                </div>
                <div class="author_item" style="margin-top: 10px; padding-bottom: 20px; border-bottom: 1px solid #e3e3e3;">
                    <span style="font-weight: bold; font-family: 仿宋;font-size: 2px;">发布：</span>
                    <span class="author" style="color: #a4aaae;font-size: 3px;">{{$article->author}}</span>
                </div>
            </div>
            {{--<div class="footer_btn">--}}
                {{--<el-button class="callback_btn" size="small" style="margin-top: 10px;" onClick="history.go(-1);">返回</el-button>--}}
            {{--</div>--}}
        </div>
    </el-col>
    @endif
</el-row>
        <!--tools_bar-->
    <div class="tools_bar">
        <div class="tools_item">
            @if(!empty($prev_id))
                <div class="pre_item">
                    <a href="{{route('article_show',array('id'=>$prev_id))}}" class="pre_article">上一篇</a>
                    <span class="aticle_name"></span>
                </div>
                @endif
            @if(!empty($next_id))
                <div class="nex_item">
                    <a href="{{route('article_show',array('id'=>$next_id))}}" class="nex_article">下一篇</a>
                    <span class="aticle_name"></span>
                </div>
                @endif
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.poptrox.min.js')}}"></script>
@endsection
@extends('layouts.app')
<!-- Styles -->
<link href="{{asset('css/classificationlist.css')}}" rel="stylesheet">
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
                        <a href="/">{{ config('app.name', 'laravel') }}</a>
                    </li>
                    <li><a  href="/home">首页</a></li>
                    <li class="active">分类列表</li>
                </ul>
            </div>

            <!--分类列表-->
            <div class="show_box">
                <div class="row is-flex">
                    @if(!empty($classifications))
                        @foreach($classifications as $classification)
                            <div class="col-sm-6 col-md-4 col-xs-12">
                                <article class="post post-card">
                                    @if(!empty($classification->img))
                                        <a href="{{route('article_list',array('id'=>$classification->id))}}" class="parmalink">
                                            <div class="featured-image"><img style="position: center" src="{{$classification->img}}"/></div>
                                        </a>
                                        @endif
                                    <div class="contnet-wrap">
                                        <div class="entry-header align-center">
                                            <span class="category">
                                                <a href="" rel="articlemark">{{$classification->articles_number}} 篇文章</a>
                                            </span>
                                            <h2 class="title h4"><a href="{{route('article_list',array('id'=>$classification->id))}}" rel="articlemark">{{$classification->name}}</a></h2>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                      @endif
                </div>
            </div>

            <!--文章列表-->
            <div class="article_list">
            </div>
        </div>
    </div>
@endsection
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
                        <a href="/">Yue_blog</a>
                    </li>
                    <li><a  href="/home">首页</a></li>
                    <li class="active">分类列表</li>
                </ul>
            </div>

            <!--分类列表-->
            <div class="show_box">
            @if(!empty($classifications))
                @foreach($classifications as $classification)
                <div class="warp-classification box">
                    <div class="classification_name title hd"><h4><a href="{{route('article_list',array('id'=>$classification->id))}}">{{$classification->name}}</a></h4></div>
                </div>
                @endforeach
              @endif
            </div>

            <!--文章列表-->
            <div class="article_list">
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')
<!-- Styles -->
<link href="{{asset('css/contact.css')}}" rel="stylesheet">
<style>
    .gtco-cover{
        background: url("{{'/images/welcome.jpg'}}");
    }
</style>
@section('content')
    <!--header-->
    <header id="gtco-header" class="gtco-cover" role="banner" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div id="main-content">
                    <article>
                        <div class="art-content">
                            <div class="row">
                                <div class="col-md-4 box-item">
                                    <h3>联系信息</h3>
                                    <span>这是我的基本信息，欢迎联系我！！</span><br><br>
                                    <section>
                                        <ul class="contact">
                                            <li class="fa fa-twitter">
                                                <a href="#"><span>twitter.com/untitled-tld</span></a>
                                            </li>
                                            <li class="fa fa-facebook">
                                                <a href="#"><span>facebook.com/untitled-tld</span></a>
                                            </li>
                                            <li class="fa fa-envelope">
                                                <a href="#"><span>information@untitled-tld</span></a>
                                            </li>
                                            <li class="fa fa-phone">
                                                <a href="#"><span>information@untitled-tld</span></a>
                                            </li>
                                            <li class="fa fa-mobile">
                                                <a href="#"><span>+86 18304081289</span></a>
                                            </li>
                                        </ul>
                                    </section>
                                </div>
                                <div class="col-md-8 box-item">
                                    <h3>联系我</h3>
                                    <form name="form1" method="POST" action="post_contact">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-lg" name="name" id="name" placeholder="请输入姓名" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control input-lg" name="email" id="email" placeholder="请输入邮箱" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<input type="text" class="form-control input-lg" name="subject" id="subject" placeholder="Subject" required="required" />--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" id="message" class="form-control" rows="4" cols="25" required="required"
                                                    placeholder="信息内容" style="height: 140px;"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-skin btn-block" name="submitcontact" id="submitcontact">发送</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="mouse-icon margin-20">
                <div class="scroll"></div>
            </div>
        </div>
    </header>
    <div class="embed-container maps">
    <iframe src="http://map.baidu.com/?newmap=1&ie=utf-8&s=s%26wd%3Dkunming" width="100%" height="450px" frameborder="0" style="border: 0"></iframe>
    </div>
@endsection
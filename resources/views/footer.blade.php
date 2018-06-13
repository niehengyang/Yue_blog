<div class="line"></div>
<footer>
    <div class="wrap-footer">
        <div class="container">
            <div class="row">
                <div class="col-footer col-md-3">
                    <h2 class="footer-title">
                        <p>关于我们</p>
                    </h2>
                    <div class="textwidget">
                        <p>这是关于我们的描述，想要了解更多请关注我们！！</p>
                    </div>
                </div>
                <div class="col-footer col-md-3 widget_recent_entries">
                    <h2 class="footer-title">
                        <p>最受欢迎的帖子</p>
                    </h2>
                    @if(!empty($popular_articleList))
                        <ul>
                            @foreach($popular_articleList as $popular_article)
                            <li>
                                <div class="post-entry">
                                    <div class="post-img">
                                        <a href="{{route('article_show',array('id'=>$popular_article->id))}}"><img src="{{$popular_article->img}}" class="img-responsive" alt="this is a popular article"></a>
                                    </div>
                                </div>
                                <div class="post-copy">
                                    <h4><a href="{{route('article_show',array('id'=>$popular_article->id))}}">{{$popular_article->title}}</a></h4>
                                    <a href="#" class="post-meta"><span class="date-posted"><time style="color: #a4aaae;" class="fa fa-calendar date" datetime="{{$popular_article->created_at->format('C')}}" itemprop="datePublished" pubdate="">&nbsp;{!!$popular_article->created_at->format('d F,Y')!!}</time></span></a>
                                </div>
                            </li>
                                @endforeach
                        </ul>
                        @else
                        <div>暂无信息</div>
                        @endif
                </div>
                <div class="col-footer col-md-3">
                    <h2 class="footer-title">
                        <p>新闻信</p>
                    </h2>
                    <p style="vertical-align: inherit;">如果您想收到我们的最新消息直接发送到您的电子邮箱，请在下面留下您的电子邮件地址。订阅式免费的，您可以随时取消。</p>
                    <form action="#" method="post">
                        <input type="text" name="your-name" value size="40" placeholder="您的邮箱">
                        <p style="vertical-align: inherit">
                            <input type="submit" value="订阅" class="btn btn-skin">
                        </p>
                    </form>
                </div>
                <div class="col-footer col-md-3">
                    <h2 class="footer-title">
                        <p>分类</p>
                    </h2>
                    <div class="footer-tags">
                        @if(!empty($classifications))
                            @foreach($classifications as $classification)
                                <a href="{{route('article_list',array('id'=>$classification->id))}}">{{$classification->name}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>@1999-2008 CSDN版权所有</p>
                    <p>京ICP证09002463号</p>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li><a href="#">隐私政策</a></li>
                        <li><a href="#">使用条款</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
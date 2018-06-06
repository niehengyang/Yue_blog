
;(function () {
    'user strict';

    var mobileMenuOutsideClick = function () {
        $(document).click(function (e) {
            var container = $("#gtco-offcanvas,.js-gtco-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length == 0){
                if ($('body').hasClass('offcanvas')){
                    $('body').removeClass('offcanvas');
                    $('.js-gtco-nav-toggle').removeClass('active')
                }
            }
        });
    };

/* 当滚动窗口距离顶部大于50个长度的时候给页面body块添加class=“scrolled”属性
* 同时找到class=“js-gtco-nav-toggle”的块将其class属性中的“gtco-nav-white”移除
* 当窗口距离顶部小于50的时候则相反。
* */
    var scrollNavBar = function () {
        if ($(window).scrollTop() > 50){
            $('body').addClass('scrolled');
            $('.js-gtco-nav-toggle').removeClass('gtco-nav-white');
        }else {
            $('body').removeClass('scrolled');
            $('.js-gtco-nav-toggle').addClass('gtco-nav-white');
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() > 50){
                $('body').addClass('scrolled');
                $('.js-gtco-nav-toggle').removeClass('gtco-nav-white');
            }else {
                $('body').removeClass('scrolled');
                $('.js-gtco-nav-toggle').addClass('gtco-nav-white');
            }
        });
    };

    /**
     * 首先向id=“page”的块中前置一个<div id="gtco-offcanvas"/>和一个
     * <a href="#" class="js-gtco-nav-toggle gtco-nav-toggle gtco-nav-white"><i></i></a>
     * 再将class=“menu-1”的所有ul克隆添加到<div id="gtco-offcanvas"/>中
     */
    var offcanvasMenu = function () {
        $('#page').prepend('<div id="gtco-offcanvas"/>');
        $('#page').prepend('<a href="#" class="js-gtco-nav-toggle gtco-nav-toggle gtco-nav-white"><i></i></a>');
        var clonel = $('.menu-1 > ul').clone();
        $('#gtco-offcanvas').append(clonel);
        var clone2 = $('.menu-2 > ul').clone();
        $('#gtco-offcanvas').append(clone2);

        //调整窗口大小的时候如果body块中有class="offcanvas"属性则将其移除
        // 并将class="js-gtco-nav-toggle"的class="active"属性也一起移除
        $(window).resize(function () {
            if ($('body').hasClass('offcanvas')){
                $('body').removeClass('offcanvas');
                $('.js-gtco-nav-toggle').removeClass('active');
            }
        });
    };

    var burgerMenu = function () {
        $('body').on('click','.js-gtco-nav-toggle',function (event) {
            var $this = $(this);

            if($('body').hasClass('overflow offcanvas')){
                $('body').removeClass('overflow offcanvas');
            }else {
                $('body').addClass('overflow offcanvas');
            }
            $this.toggleClass('active');
            event.preventDefault();
        });
    };

    var counterWayPoint = function () {
        if ($('#gtco-counter').length > 0){
            $('#gtco-counter').waypoint(function (direction) {
                if(direction === 'down' && !$(this.element).hasClass('animated')){
                    setTimeout(counter,400);
                    $(this.element).addClass('animated');
                }
            },{offset:'90%'});
        }
    };

    // var parallax = function () {
    //     if (!isMobile.any()){
    //         $(window).stellar();
    //     }
    // };

    $(function () {
        mobileMenuOutsideClick();
        scrollNavBar();
        offcanvasMenu();
        burgerMenu();
        counterWayPoint();
        // parallax();
    });

}());
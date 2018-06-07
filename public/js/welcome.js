
;(function () {
    'user strict';

    var isMobile = {
        Android:function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry:function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS:function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera:function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows:function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any:function () {
            return (isMobile.Android()||isMobile.BlackBerry()||isMobile.iOS()||isMobile.Opera()||isMobile.Windows());
        }
    };

    var mobileMenuOutsideClick = function () {
        $(document).click(function (e) {
            var container = $("#gtco-offcanvas,.js-gtco-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0){
                if ($('body').hasClass('offcanvas')){
                    $('body').removeClass('offcanvas');
                    $('.js-gtco-nav-toggle').removeClass('active');
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
        $('#gtco-offcanvas .has-dropdown').addClass('offcanvas-has-dropdown');
        $('#gtco-offcanvas')
            .find('li')
            .removeClass('has-dropdown');
        $('.offcanvas-has-dropdown').mouseenter(function () {
            var $this = $(this);
            $this.addClass('active')
                .find('ul')
                .slideDown(500,'easeOutExpo');
        }).mouseleave(function () {
            var $this = $(this);
            $this.removeClass('active')
                .find('ul')
                .slideUp(500,'easeOutExpo');
        });

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

    var contentWayPoint = function () {
        var i = 0;
        $('.animate-box').waypoint(function (direction) {
            if(direction === 'down' && !$(this.element).hasClass('animated-fast')){
                i++;
                $(this.element).addClass('item-animate');
                setTimeout(function () {
                    $('body .animate-box.item-animate').each(function (k) {
                        var el = $(this);
                        setTimeout(function () {
                            var effect = el.data('animate-effect');
                            if (effect === 'fadeIn'){
                                el.addClass('fadeIn animated-fast');
                            }else if(effect === 'fadeInLeft'){
                                el.addClass('fadeInLeft animated-fast');
                            }else if(effect === 'fadeInRight'){
                                el.addClass('fadeInRight animated-fast');
                            }else {
                                el.addClass('fadeInUp animated-fast');
                            }
                            el.removeClass('item-animate');
                        },k * 50,'easeInOutExpo');
                    });
                },100);
            }
        },{offset:'85%'});
    };

    var dropdown = function () {
        $('has-dropdown').mouseenter(function () {
            var $this = $(this);
            $this.find('.dropdown')
                .css('display','block')
                .addClass('animated-fast fadeInUpMenu');
        }).mouseleave(function () {
            var $this = $(this);
            $this.find('.dropdown')
                .css('display','none')
                .removeClass('animated-fast fadeInUpMenu')
        });
    };

    var goToTop = function () {
        $('.js-gotop').on('click',function (event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $('html').offset().top
            },500,'easeInOutExpo');

            return false;
        });
        $(window).scroll(function () {
            var $win = $(window);
            if($win.scrollTop() > 200){
                $('.js-top').addClass('active');
            }else{
                $('.js-top').removeClass('active');
            }
        });
    };

    // var counterWayPoint = function () {
    //     if ($('#gtco-counter').length > 0){
    //         $('#gtco-counter').waypoint(function (direction) {
    //             if(direction === 'down' && !$(this.element).hasClass('animated')){
    //                 setTimeout(counter,400);
    //                 $(this.element).addClass('animated');
    //             }
    //         },{offset:'90%'});
    //     }
    // };

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
        // counterWayPoint();
        // parallax();
    });

}());
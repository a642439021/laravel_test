@extends('layout')
@section('content')
<div class="container">
    <div class="banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
            	@foreach($ad as $val)
            	    <a href="{{$val->ad_link or 'javascript:void(0)'}}" title="{{$val->ad_name}}" class="swiper-slide"><img src="{{asset($val->ad_code)}}" width="100%"></a>
				@endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="menu clearfix">
        <a href="{{route('park')}}" class="li">
            <img class="icon" src="{{asset('image/menu_ic_1.png')}}">
            <p class="fs28">停车缴费</p>
        </a>
        <if condition="empty($user['mobile'])">
            <a href="{:U('Mobile/User/bind')}" class="li">
                <img class="icon" src="{{asset('image/menu_ic_2.png')}}">
                <p class="fs28">注册会员</p>
            </a>
            <else/>
            <a href="javascript:alert('您已绑定手机号');" class="li">
                <img class="icon" src="{{asset('image/menu_ic_2.png')}}">
                <p class="fs28">注册会员</p>
            </a>
        </if>
        <a href="{:U('Mobile/Article/arrange')}" class="li">
            <img class="icon" src="{{asset('image/menu_ic_3.png')}}">
            <p class="fs28">每日签到</p>
        </a>
        <a href="{:U('Mobile/Article/index',array('article_id'=>4))}" class="li">
            <img class="icon" src="{{asset('image/menu_ic_4.png')}}">
            <p class="fs28">会员特权</p>
        </a>
    </div>
    <div class="activity_tab">
    	@foreach($ad1 as $v)
            <a href="{{$v->ad_link}}" title="{{$v->ad_name}}" class="li"><img class="li_pic" src="{{asset($v->ad_code)}}" width="100%"></a>
        @endforeach
    </div>
    @if(!empty($notice))
    	<div class="notice mb18">
            <div class="notice_ic"></div>
            <div class="notice_box">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($notice as $vo)
                            <a href="{{$vo->link}}" class="swiper-slide fs26">{{$vo->title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <notempty name="adv">
        <div class="theme mt18">
            <div class="theme_tit fs36">精选特惠</div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($ad2 as $v)
                        <a href="{{$v['ad_link']}}" class="swiper-slide"><img src="{{asset($v->ad_code)}}" width="100%"></a>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </notempty>
    <notempty name="adv2">
        <div class="adv_silde mt18">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($ad3 as $v)
                        <a href="{{$v->ad_link}}}" class="swiper-slide"><img src="{{asset($v->ad_code)}}" width="100%"></a>
                    @endforeach
                </div>
            </div>
        </div>
    </notempty>
    <!-- 优惠券列表 -->
    <div class="coupon clearfix mt18">
        <div class="coupon_tab fs28">
            <ul>
                <li><a href="javascript:;" id="whole" onclick="getStoreList(this,0)" class="active">全部</a></li>
                @foreach($cate as $vo)
                    <li><a href="javascript:void(0);" onclick="getStoreList(this,{{$vo->category_id}})">{{$vo->category_name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="store_list" id="storeList">
        </div>
    </div>
    <!-- 底部 -->
    <div class="h106"></div>
    <div class="foot"><include file="public/footer"/></div>
</div>

<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
    wx.config({
        debug: false,
        appId: "{$signPackage['appId']}",
        timestamp: '{$signPackage["timestamp"]}',
        nonceStr: '{$signPackage["nonceStr"]}',
        signature: '{$signPackage["signature"]}',
        jsApiList: ['updateAppMessageShareData','updateTimelineShareData']
    });
    var title = "奥永广场";
    var desc = "一座有温度的休闲综合体";
    var link = window.location.href;
    var imgUrl = "http://"+window.location.host+"/public/dist/img/logo.png";
    wx.ready(function () {
        wx.updateAppMessageShareData({
            title: title, // 分享标题
            desc: desc, // 分享描述
            link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: imgUrl, // 分享图标
            success: function () {
                // 设置成功
            }
        })
        wx.updateTimelineShareData({
            title: title, // 分享标题
            link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: imgUrl, // 分享图标
            success: function () {
                // 设置成功
            }
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#whole').click();
    });
    var swiper = new Swiper('.banner .swiper-container', {
        autoplay: {
            delay: 4000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
        },
    });
    if($(".theme .swiper-container .swiper-slide").size() != 1){
        var swiper2 = new Swiper('.theme .swiper-container', {
            autoplay: {
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
            },
            loop: true,
            slidesPerView: 'auto',
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
            },
        });
    }
    var swiper3 = new Swiper('.notice_box .swiper-container', {
        direction : 'vertical',
        loop: true,
        autoplay: {
            delay: 3500,
        },
        allowTouchMove: false,
    });

    if($(".adv_silde .swiper-container .swiper-slide").size() != 1){
        var swiper4 = new Swiper('.adv_silde .swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false,
            }
        });
    }

    var cid = -1;
    function getStoreList(obj,id) {
        $('#storeList').off('scroll');
        if(cid!=id){
            cid = id;
        }else{
            return false;
        }
        $(".coupon_tab ul li a").removeClass('active');
        $(obj).addClass('active');
        $("#storeList").html('');
        layui.use('flow',function () {
            var $ = layui.jquery;
            var flow = layui.flow;
            flow.load({
                elem:"#storeList"
                ,end:" "
                ,done:function (page,next) {
                    $.ajax({
                        type:"post",
                        url:"{{route('getStoreList')}}",
                        data:{page:page,cid:cid},
                        dataType:"json",
                        success:function (data) {
                                if(data.cid == cid){
                                $(".layui-flow-more").before(data.html);
                                next('', page < data.pages);
                            }
                        }
                    })
                }
            })
        })
    }
</script>
@stop

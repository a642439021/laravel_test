@include('layout')
@section('content')
    <div class="container">
        <div class="banner" style="background: none">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <adv pid='4' limit='100' item='v'>
                        <a href="{$v['ad_link']|default='javascript:void(0);'}" title="{$v.ad_name}" class="swiper-slide"><img src="{$v.ad_code}" width="100%"></a>
                    </adv>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="park_list" style="padding-top: .4rem">
            <foreach name="list" item="vo">
                <a href="{:U('Park/getcarinfo',array('log_id'=>$vo['log_id']))}" class="li">
                    <span class="fs46">{$vo.car_no}</span>
                </a>
            </foreach>
            <a href="{:U('Park/park_add')}" class="addli"><span class="fs32">点击添加车牌号</span></a>
        </div>
    </div>
    <!-- 底部 -->
    <div class="h106"></div>
    <div class="foot">
        <include file="public/footer"/>
    </div>
    <script>
        if ($(".banner .swiper-container .swiper-slide").size() !=1){
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
        }
    </script>
@stop
@extends('layout')
@section('content')
    <div class="container bg_white">
        <form action="" method="post" id="my_car">
            <div class="park_add_main">
                <div class="park_add_name fs36">输入车牌</div>
                <div class="park_add_box">
                    <input type="text" id="province" onfocus="this.blur();" name="carNo[]" class="text fs44 input_static">
                    <input type="text" onfocus="this.blur();" name="carNo[]" class="text fs44 input_static">
                    <span class="spot"></span>
                    <input type="text" onfocus="this.blur();" name="carNo[]" class="text fs44 input_static">
                    <input type="text" onfocus="this.blur();" name="carNo[]" class="text fs44 input_static">
                    <input type="text" onfocus="this.blur();" name="carNo[]" class="text fs44 input_static">
                    <input type="text" onfocus="this.blur();" name="carNo[]" class="text fs44 input_static">
                    <input type="text" onfocus="this.blur();" name="carNo[]" class="text fs44 input_static">
                    <input type="text" style="display: none;" onfocus="this.blur();" name="carNo[]" class="text fs44 hidden input_static">
                    <div class="btn" id="input_btn">
                        <div class="btn_ic"></div>
                        <div class="btn_t fs20 add_btn">新能源</div>
                    </div>
                </div>
                <div class="park_add_bott"><button type="button" onclick="do_submit()" class="btn fs36">确定</button></div>
            </div>
            <input type="hidden" name="type" value="{$type}">
            {{ csrf_field() }}
        </form>
        <div class="keyboard" >
            <div class="keyboard_main fs44">
                <div class="keyboard_box" id="car_no">

                </div>
                <div class="keyboard_box" id="car_en">

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/car_city.js') }}"></script>
    <script>
        var cur_input = 0;
        $(".input_static").focus(function () {
            var index = $(".input_static").index(this);
            cur_input = index;
            var ps = $(".input_static").eq(0).val();
            if(!ps&&index==1){
                layer.msg('请先选择省份');
                return false;
            }
            $(".keyboard").addClass("active");
            $(".keyboard_box").show();
            if(index==0){
                var keyboards = pShort;
            }else if(index==1){
                var keyboards = city_cars[ps];
            }else if(index>1){
                var keyboards = keyNums;
            }
            var keyhtml = '';
            var numkey = '';
            $.each(keyboards,function (i,v) {
                if(v>=0){
                    numkey += '<div class="li"><label onclick="choosekey(this,\''+index+'\')">'+v+'</label></div>';
                }else{
                    keyhtml += '<div class="li"><label onclick="choosekey(this,\''+index+'\')">'+v+'</label></div>';
                }
            });
            if(numkey){
                $("#car_no").html(numkey);
            }else{
                $("#car_no").html('');
            }
            keyhtml +='<div class="btn_del"></div>';
            $("#car_en").html(keyhtml);
            $(".keyboard").show();
            $(".keyboard").css('transform','translateY(0)');
            $('.btn_del').attr('onclick',"delkey('"+index+"')");
        });
        function choosekey(obj,index) {
            var province = $(obj).html();
            if(index==0){
                $(".input_static").val('');
            }
            $(".input_static").eq(index).val(province);
            if(index==0){
                return $(".input_static").eq(index+1).focus();
            }else if(index==1){

                $(".keyboard").css('transform','translateY(100%)');
                $(".keyboard").hide();
                return $("input").eq(2).focus();
            }else if(index>1){
                $(".keyboard").css('transform','translateY(100%)');
                $(".keyboard").hide();
                return $("input").eq((index*1+1)).focus();
            }
        }
        function delkey(index) {
            $(".input_static").eq(index).val('');
            if(index>=1){
                $(".input_static").eq(index-1).focus();
            }
        }
        $(".add_btn").click(function () {
            $("#input_btn").hide();
            $(".hidden").show();
            $(".hidden").focus();
        });
        $(".hidden").click(function () {
            if(!$(".hidden").val()){
                $(".hidden").hide();
                $("#input_btn").show();
            }
        });
        function do_submit(){
            $.post("{{route('addpark')}}",$("#my_car").serialize(),function (res) {
                if(res.code==1){
                    location.href= res.url;
                }else{
                    if(res.code==-2){
                        layer.confirm(res.msg, {
                            btn: ['联系客服','关闭'], //按钮
                            area: ['280px', 'auto'],
                        }, function(){
                            window.location.href="tel:"+res.tel;
                        }, function(){

                        });
                    }else{
                        layer.msg(res.msg);
                    }
                    return false;
                }
            },'json').error(function () {
                layer.msg('请求失败！',{offset:'b',anim:2,area:['100%']});
                layer.close(index);
            });
        }
    </script>
    </body>
    </html>
@stop
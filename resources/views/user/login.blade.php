@extends('layout')
@section('title')-会员登录@stop
@section('content')
    <div class="container bg_white">
        <div class="user_bind">
            <form action="" method="post" id="mybind">
                <div class="li">
                    <div class="li_name fs30">手机号</div>
                    <div class="li_box"><input type="text" name="mobile" id="mobile" class="text fs28" placeholder="请输入手机号"></div>
                </div>
                <div class="li">
                    <div class="li_name fs30">验证码</div>
                    <div class="li_box pr216">
                        <input type="text" class="text fs28" name="mobile_code" id="mobile_code" placeholder="请输入验证码">
                        <div rel="mobile" onClick="sendcode(this)" id="code_btn1" class="btn_code fs26">获取验证码</div>
                        <div id="code_btn2" style="display:none;" class="btn_code fs26 bg_gray">已发送(<span id="count_down">0</span>)</div>
                    </div>
                </div>
                <div class="protocol">
                    <input type="checkbox" class="checkbox" id="protocol_check" checked>
                    <a href="{:U('Mobile/user/protocol')}" class="fs26 link">《用户注册协议》</a>
                </div>
                <div onclick="do_submit()" class="user_bind_bott"><button type="button" class="btn fs36">立即登录</button></div>
            </form>
        </div>
    </div>
    <script>
        function sendcode(obj){
            var mobile = $.trim($('#mobile').val());
            if(checkMobile(mobile)){
                $.ajax({
                    url:  '/Api/send_code/t/'+Math.random() ,
                    type:'post',
                    dataType:'json',
                    data:{type:$(obj).attr('rel'),send:mobile,scene:7,'_token':'{{ csrf_token() }}'},
                    success:function(res){
                        if(res.status==1){
                            layer.msg(res.msg,{icon:1});
                            $('#code_btn1').hide();
                            $('#code_btn2').show();
                            countdown();
                        }else{
                            layer.msg(res.msg,{icon:2});
                        }
                    }
                })
            }else{
                layer.msg('请正确填写手机号码',{icon:2});
            }
        }
        var wait = 60;
        function countdown() {
            if (wait <=0) {
                $('#code_btn1').show();
                $('#code_btn2').hide();
                wait = 60;
            } else {
                $("#count_down").html(wait+'s');
                wait--;
                setTimeout(function() {
                    countdown();
                }, 1000)
            }
        }
        function do_submit(){
            var mobile = $.trim($('#mobile').val());
            var code = $.trim($('#mobile_code').val());
            if(!code){
                layer.msg('请填写短信验证码',{icon:2});
                return false;
            }
            if(!document.getElementById("protocol_check").checked){
                layer.msg('请同意用户注册协议',{icon:2});
                return false;
            }
            if(checkMobile(mobile)){
                $.ajax({
                    url:  "/mobile/dologin",
                    type:'post',
                    dataType:'json',
                    data:{mobile:mobile,code:code,'_token':'{{ csrf_token() }}'},
                    success:function(res){
                        layer.msg(res.msg,{icon:1});
                        if(res.code==1){
                            setTimeout(function() {
                                location.href=res.url;
                            }, 1500)
                        }
                    }
                })
            }else{
                layer.msg('请正确填写手机号码',{icon:2});
            }
        }
    </script>
    </body>
    </html>
@stop
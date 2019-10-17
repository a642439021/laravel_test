<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Mobile\MobileBaseCrontroller;
use Illuminate\Http\Request;
use App\Model\User;

class UserController extends MobileBaseCrontroller
{
    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $login_code = session('loginmobile');
            $mobile = $request->mobile;
            $code = $request->code;
            if($login_code == $mobile.config('app.pwdstr').$code){
                $user_id = User::where(['mobile'=>$mobile])->value('user_id');
                session(['user_id'=>$user_id]);
                $url = session('referurl');
                if(!$url){
                    $url = route('index');
                }else{
                    $url = session('referurl');
                }
                return json_encode(['code'=>1,'msg'=>'登录成功','url'=>$url]);
            }else{
                return json_encode(['code'=>2,'msg'=>'验证码错误']);
            }
        }else{
            session('referurl',url()->previous());
            return view('user.login');
        }
    }

}
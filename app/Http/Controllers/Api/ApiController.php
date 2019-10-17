<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sendValidateCode(Request $request)
    {
        $random = random();
        $mobile = $request->send;
        Session::set('loginmobile',$mobile.config('app.pwdstr').$random);
        $result = [
            'status'=>1,
            'msg'=>'发送成功'.$random
        ];
        return json_encode($result);
    }
}
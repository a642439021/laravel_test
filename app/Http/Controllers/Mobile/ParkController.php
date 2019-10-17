<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Mobile\MobileBaseCrontroller;
use Illuminate\Http\Request;
use App\Model\UserCar;
use App\Model\Ad;

class ParkController extends MobileBaseCrontroller
{
    public $user_id = 0;

    public function index()
    {
        if(!$this->checkLogin()){
            return redirect()->route('login');
        }
        $user_id = session('user_id');
        $list = UserCar::where(['user_id'=>$user_id])->get();
        $ad = Ad::where(['pid'=>1,'enabled'=>1])->orderBy('orderby','desc')->get();
        return view('park.index',[
            'list'=>$list,
            'ad'=>$ad
        ]);
    }
    //添加车辆信息
    public function addCar(Request $request)
    {
        if($request->isMethod('post')){
            dump($request);
        }else{
            return view('park.addCar');
        }
    }
}
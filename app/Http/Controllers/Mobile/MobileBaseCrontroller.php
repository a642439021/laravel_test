<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileBaseCrontroller extends Controller
{
    public function __construct()
    {
//        if(!$this->checkLogin()){
//            $tmp = $this->getContrllerInfo();
//            if($tmp['method']!='login'){
//                header('Location: '.route('login'));
//                exit();
//            }
//        }
    }
    public function getContrllerInfo()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        $class = substr(strrchr($class,"\\"),1);
        return ['controller' => $class, 'method' => $method];
    }
    public function checkLogin()
    {
        $user_id = session('user_id',0);
        if($user_id<=0){
            return false;
        }else{
            return true;
        }
    }
}
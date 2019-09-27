<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Mobile\MobileBaseCrontroller;
use App\Http\Requests\Request;
use App\Model\UserCar;
use Illuminate\Support\Facades\Session;

class ParkController extends MobileBaseCrontroller
{
    public $user_id = 0;

    public function index()
    {
        return Session::get('message');
        var_dump(Session::all());die;
        if(!$this->checkLogin()){
            return redirect()->route('login');
        }
        return view('park.index');
    }
}
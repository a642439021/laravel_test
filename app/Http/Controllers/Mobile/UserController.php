<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Mobile\MobileBaseCrontroller;

class UserController extends MobileBaseCrontroller
{
    public function login()
    {
        return '我是登录页';
    }
}
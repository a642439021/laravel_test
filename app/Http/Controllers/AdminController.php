<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
	public function index()
	{
	    session()->put('key3','value3');
	}
    public function login()
    {
        echo session()->get('key3');
    }
	public function backendLogin()
    {
        session()->put('backend_user','我是后台管理员session');
    }
    public function userInfo()
    {
        echo session()->get('backend_user');
    }
}
?>
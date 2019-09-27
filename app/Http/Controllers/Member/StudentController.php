<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Member\MemberBaseController;
use Illuminate\Support\Facades\DB;
use App\Task;

class StudentController extends MemberBaseController
{
    public function index()
    {
        $a = request()->all();
        dd($a);
    }
    public function query()
    {
        return view('student/query',['name'=>'lqw']);
    }
}
<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Model\Student;

class StudentController extends Controller
{
    public function index()
    {
        $list = Student::get();
        dd($list);die;
        return view('student.index');
    }
}
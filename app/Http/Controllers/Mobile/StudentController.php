<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Model\Student;

class StudentController extends Controller
{
    public function index()
    {
        $list = Student::get();
        return view('student.index');
    }
}
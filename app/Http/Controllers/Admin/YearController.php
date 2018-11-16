<?php

namespace App\Http\Controllers\Admin;

use App\Exam;
use App\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YearController extends Controller
{
    public function create()

    {
        $exams=Exam::all();
        $streams=Stream::all();
        return view('backend.admin.addyear',compact('streams','exams'));
    }

    public function store(Request $request)
    {
       $this->validate($request,[
           'term'=>'required',
           'exam_name'=>'required',
           'class'=>'required',
           'stream'=>'required',
           'class_teacher'=>'required',
           'year'=>'required'
       ]);

    }
}

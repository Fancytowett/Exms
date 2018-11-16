<?php

namespace App\Http\Controllers\Admin;

use App\Exam;
use App\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function create()
    {
        $streams=Stream::all();
        $exams=Exam::all();
        return view('backend.admin.addexam',compact('streams','exams'));
    }

    public function store(Request $request)
    {
      $this->validate($request,[
          'name'=>'required',
          'class'=>'required',
          'year'=>'required',
          'term'=>'required'
      ]);
      Exam::create($request->all());
      return back()->with('SucessMsg','Exam successfully saved');

    }
}

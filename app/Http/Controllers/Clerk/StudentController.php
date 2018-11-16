<?php

namespace App\Http\Controllers\Clerk;

use App\Darasa;
use App\Guardian;
use App\Stream;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function create()
    {
        $darasas=Darasa::all();
        $streams= Stream::all();
        $guardians= Guardian::all();
       return view('backend.clerk.add_student',compact('streams','darasas','guardians'));
    }

    public function store(Request $request)
    {
   $this->validate($request,[
       'fname'=>'required',
       'lname'=>'required',
        'stream_id'=>'required',
       'year'=>'required',
       'class'=>'required',
       'adm_no'=>'required'
   ]);


   $student = new Student();
   $student->fname=$request->input('fname');
   $student->mname=$request->input('mname');
   $student->lname=$request->input('lname');
   $student->year=$request->input('year');
   $student->adm_no=$request->input('adm_no');
   $student->stream_id=$request->input('stream_id');
   $student->save();

   return back()->with('successMsg','Student Successfully added');
    }
}

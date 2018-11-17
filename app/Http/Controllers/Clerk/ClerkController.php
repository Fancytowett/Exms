<?php

namespace App\Http\Controllers\Clerk;

use App\Contact;
use App\Darasa;
use App\Guardian;
use App\Stream;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClerkController extends Controller
{
    public function guardianCreate()
    {
        return view('backend.clerk.add_parent');
    }
    public function guardianStore(Request $request)
    {
        $this->validate($request,[
            'fname'=>'required',
            'lname'=>'required',
            'phone1'=>'required|min:10',
            'phone2'=>'required|min:10',

        ],[
            'stud_adm_no'=>'Admission number must be unique'
        ]);
        $guardian =new Guardian();
        $guardian->fname=$request->input('fname');
        $guardian->lname=$request->input('lname');
        $guardian->phone1=$request->input('phone1');
        $guardian->phone2=$request->input('phone2');
        $guardian->save();

        return redirect()->back()->with('successMsg','Guardian successfully saved');

    }

    public function add_contact()
    {
        return view('backend.clerk.addcontact');
    }

    public function contact_save(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required'
        ]);
        Contact::create($request->all());

        return back()->with('SuccessMsg','Contact successfully created');
    }
    public function studentCreate()
    {
        $darasas=Darasa::all();
        $streams= Stream::all();
        $guardians= Guardian::all();
        return view('backend.clerk.add_student',compact('streams','darasas','guardians'));
    }

    public function studentStore(Request $request)
    {
        $this->validate($request,[
            'fname'=>'required',
            'lname'=>'required',
            'stream_id'=>'required',
            'year'=>'required',
            'phone'=>'required',
            'class_id'=>'required',
            'adm_no'=>'required'
        ]);


        $student = new Student();
        $student->fname=$request->input('fname');
        $student->mname=$request->input('mname');
        $student->lname=$request->input('lname');
        $student->year=$request->input('year');
        $student->phone=$request->input('phone');
        $student->adm_no=$request->input('adm_no');
        $student->stream_id=$request->input('stream_id');
        $student->class_id=$request->input('class_id');

        $student->save();

        return back()->with('successMsg','Student Successfully added');
    }
}

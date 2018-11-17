<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Darasa;
use App\Exam;
use App\Stream;
use App\Student;
use App\Student_subject;
use App\Subject;
use App\Teacher_subject_class;
use App\Term;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function classCreate()
    {
        return view('backend.admin.addclass');
    }

    public function ClassStore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        Darasa::create($request->all());

        return back()->with('SuccessMsg','Class successfully added');
    }

    public function examCreate()
    {
        $streams=Stream::all();
        $exams=Exam::all();
        return view('backend.admin.addexam',compact('streams','exams'));
    }

    public function examStore(Request $request)
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
    public function streamCreate()
    {
        return view('backend.admin.addstream');
    }

    public function streamStore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        Stream::create($request->all());
        return back()->with('SuccessMsg','Stream successfully added');
    }
    public function subjectCreate()
    {
        return view('backend.admin.addsubject');

    }

    public function subjectStore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'short_name'=>'required'


        ]);
        Subject::create($request->all());

        return redirect()->back()->with('successMsg','Subject successfully added');
    }

    public function grade_create()
    {
        $subjects =Subject::all();
        return view('backend.admin.grade',compact('subjects'));
    }

    public function grade_save(Request $request)
    {
        $this->validate($request,[
            'subject_id'=>'required',
            'minrange'=>'required|numeric',
            'maxrange'=>'required|numeric',

        ]);


        $grade= new Grade();
        $grade->subject_id=$request->input('subject_id');
        $grade->minrange=$request->input('minrange');
        $grade->maxrange=$request->input('maxrange');
        $grade->grade=$request->input('grade');
        $grade->save();

        return back()->with('successMsg','Grade successfully added');
    }
    public function termCreate()
    {
        return view('backend.admin.addterm');

    }

    public function termStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        Term::create($request->all());

        return back()->with('SuccessMsg','Term successfully added');
    }
    public function yearCreate()

    {
        $exams=Exam::all();
        $streams=Stream::all();
        $darasas=Darasa::all();
        return view('backend.admin.addyear',compact('streams','exams','darasas'));
    }

    public function yearStore(Request $request)
    {
        $this->validate($request,[
            'term'=>'required',
            'exam_name'=>'required',
            'class'=>'required',
            'stream'=>'required',
            'class_teacher'=>'required',
            'year'=>'required'
        ]);
        return back()->with('SuccessMsg','Year successfully recorded');

    }
    public function add_subjectteacher()
    {
        $subjects= Subject::all();
        $users=User::all();
        $darasas=Darasa::all();
        $streams=Stream::all();
        return view('backend.admin.add_subject_teacher',compact('subjects','darasas','users','streams'));
    }

    public function subjectteacher_save(Request $request)
    {
        $this->validate($request,[
            'subject_id'=>'required',
            'stream_id'=>'required',
            'user_id'=>'required',
            'darasa_id'=>'required',
        ]);
        Teacher_subject_class::create($request->all());
        return back()->with('successMsg','Subject Teacher successfully added');

    }
    public function add_studentsubject()
    {
        $subjects= Subject::all();
        $users=User::all();
        $students=Student::all();
        return view('backend.admin.add_student_subject',compact('subjects','users','students'));
    }

    public function studentsubject_save(Request $request)
    {
        $this->validate($request,[
            'subject_id'=>'required',
            'student_id'=>'required',
            'user_id'=>'required'

        ]);
       Student_subject::create($request->all());
        return back()->with('successMsg','Subject Teacher successfully added');

    }

    public function addcontact()
    {
        return view('backend.admin.addcontact');
    }

    public function storecontact(Request $request)
    {
     $this->validate($request,[
         'name'=>'required',
         'phone'=>'required'
     ]);
     Contact::create($request->all());

    return back()->with('successMsg','Contact added Successfully');
    }
}

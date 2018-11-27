<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Darasa;
use App\Exam;
use App\Exports\ResultsExport;
use App\Result;
use App\ResultUpload;
use App\Stream;
use App\Student;
use App\Student_subject;
use App\Subject;
use App\Teacher_subject_class;
use App\Term;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function classCreate()
    {
        return view('backend.admin.addclass');
    }

    public function ClassStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        Darasa::create($request->all());

        return back()->with('SuccessMsg', 'Class successfully added');
    }

    public function examCreate()
    {
        $streams = Stream::all();
        $exams = Exam::all();
        $darasas = Darasa::all();
        $terms = Term::all();
        return view('backend.admin.addexam', compact('streams', 'exams', 'darasas', 'terms'));
    }

    public function examStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'class_id' => 'required',
            'year' => 'required',
            'term_id' => 'required'
        ]);
        Exam::create($request->all());
        return back()->with('SuccessMsg', 'Exam successfully saved');

    }

    public function streamCreate()
    {
        return view('backend.admin.addstream');
    }

    public function streamStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        Stream::create($request->all());
        return back()->with('SuccessMsg', 'Stream successfully added');
    }

    public function subjectCreate()
    {
        return view('backend.admin.addsubject');

    }

    public function subjectStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'short_name' => 'required'


        ]);
        Subject::create($request->all());

        return redirect()->back()->with('successMsg', 'Subject successfully added');
    }

    public function grade_create()
    {
        $subjects = Subject::all();
        return view('backend.admin.grade', compact('subjects'));
    }

    public function grade_save(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'minrange' => 'required|numeric',
            'maxrange' => 'required|numeric',

        ]);


        $grade = new Grade();
        $grade->subject_id = $request->input('subject_id');
        $grade->minrange = $request->input('minrange');
        $grade->maxrange = $request->input('maxrange');
        $grade->grade = $request->input('grade');
        $grade->save();

        return back()->with('successMsg', 'Grade successfully added');
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

        return back()->with('SuccessMsg', 'Term successfully added');
    }

    public function yearCreate()

    {
        $exams = Exam::all();
        $streams = Stream::all();
        $darasas = Darasa::all();
        return view('backend.admin.addyear', compact('streams', 'exams', 'darasas'));
    }

    public function yearStore(Request $request)
    {
        $this->validate($request, [
            'term' => 'required',
            'exam_name' => 'required',
            'class' => 'required',
            'stream' => 'required',
            'class_teacher' => 'required',
            'year' => 'required'
        ]);
        return back()->with('SuccessMsg', 'Year successfully recorded');

    }

    public function add_subjectteacher()
    {
        $subjects = Subject::all();
        $users = User::all();
        $darasas = Darasa::all();
        $streams = Stream::all();
        return view('backend.admin.add_subject_teacher', compact('subjects', 'darasas', 'users', 'streams'));
    }

    public function subjectteacher_save(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'stream_id' => 'required',
            'user_id' => 'required',
            'darasa_id' => 'required',
        ]);
        Teacher_subject_class::create($request->all());
        return back()->with('successMsg', 'Subject Teacher successfully added');

    }

    public function add_contact()
    {
        return view('backend.admin.addcontact');
    }

    public function contact_save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required'
        ]);
        Contact::create($request->all());

        return back()->with('SuccessMsg', 'Contact successfully created');
    }

    public function add_studentsubject()
    {
        $subjects = Subject::all();
        $users = User::all();
        $students = Student::all();
        $darasas=Darasa::all();
        return view('backend.admin.add_student_subject', compact('subjects', 'users', 'students','darasas'));
    }

    public function studentsubject_save(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'student_id' => 'required',
            'class_id' => 'required',
            'user_id' => 'required'

        ]);
       Student_subject::create($request->all());
        return back()->with('successMsg', 'Saved successfully added');

    }

    public function addcontact()
    {
        return view('backend.admin.addcontact');
    }

    public function storecontact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required'
        ]);
        Contact::create($request->all());

        return back()->with('successMsg', 'Contact added Successfully');
    }

    public function result()
    {
        $students = Student::all();
        $users = User::all();
        $exams = Exam::all();
        $subjects = Subject::all();
        $terms = Term::all();
        return view('backend.admin.result', compact('students', 'users', 'subjects', 'exams', 'terms'));
    }

    public function resultsave(Request $request)

    {
        $this->validate($request, [
            'student_id' => 'required',
            'user_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required',
            'term_id' => 'required',
            'score' => 'required',
        ]);
        Result::create($request->all());
        return back()->with('successMsg', 'Result sucessfully recorded');
    }

    public function resultupload()
    {
        $exams = Exam::all();
        $subjects = Subject::all();
        $terms = Term::all();
        $darasas = Darasa::all();
        return view('backend.admin.result_upload', compact('students', 'users', 'subjects', 'exams', 'terms', 'darasas'));
    }

    public function resultuploadsave(Request $request)
    {

        $this->validate($request, [
            'subject_id' => 'required',
            'exam_id' => 'required',
            'term_id' => 'required',
            'class_id' => 'required',
            'csvfile' => 'required',
        ]);

        $file = $request->file('csvfile');
//        if (isset($file)) {
//            $currentDate = Carbon::now()->toDateString();
//            $filename = rand(1999999, 299999999) . "_" . $currentDate . uniqid() . "." . $file->getClientOriginalExtension();
//            if (!file_exists('uploads/results')) {
//                mkdir('uploads/results', 0777, true);
//            }
//            $file->move('uploads/results', $filename);
        $filepath = $file->getRealPath();
        $file = fopen($filepath, 'r');
        $header = fgetcsv($file);
        $escapeHeader = [];
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            $escapeItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapeHeader, $escapeItem);

        }
        while ($columns = fgetcsv($file)) {
            if ($columns[0] == "") {
                continue;
            }
            foreach ($columns as $key => &$value) {
                $value = preg_replace('/\D/', '', $value);
            }

            $data = array_combine($escapeHeader, $columns);

            foreach ($data as $key => $value) {
                $value = ($key == "model" || $key == "country") ? (string)$value : (string)$value;

            }
        }


        $resultupload = new ResultUpload();
        $resultupload->subject_id = $request->input('subject_id');
        $resultupload->exam_id = $request->input('exam_id');
        $resultupload->term_id = $request->input('term_id');
        $resultupload->class_id = $request->input('class_id');
        $resultupload->csvfile = $filepath;
        $resultupload->save();


        return back()->with('successMsg', 'Result sucessfully uploaded');
    }

    public function upload()
    {
        return view('backend.admin.trial');
    }


    public function csvstore(Request $request)
    {

//        $student = Student::where(['adm_no' => '5456'])->first();
//        dd($student);
        $file = $request->file('csvfile');
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $term_id = $request->input('term_id');
        $class_id = $request->input('class_id');
        $filepath = $file->getRealPath();
        $file = fopen($filepath, 'r');
        $header = fgetcsv($file);
        $escapeHeader = [];
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            $escapeItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapeHeader, $escapeItem);

        }
        //$data_big=[];
        $success = 0;
        $failures = 0;
        $non_existant = 0;
        $set_name=rand(10000,100000);
        while ($columns = fgetcsv($file)) {
            if ($columns[0] == "") {
                continue;
            }


            $data = array_combine($escapeHeader, $columns);
            //['subject_id','score','student_id','user_id','term_id','exam_id'];
            $student = Student::where(['adm_no' => $data['adm']])->first();

            if ($student != null) {
                $student_id = $student->id;
                $res = ResultUpload::where(['subject_id' => $subject_id,
                    'student_id' => $student_id,
                    'user_id' => Auth::user()->id,
                    'term_id' => $term_id,
                    'exam_id' => $exam_id])->first();
                if ($res == null) {

                    ResultUpload::create(['subject_id' => $subject_id,
                        'score' => $data['score'],
                        'student_id' => $student_id,
                        'user_id' => Auth::user()->id,
                        'term_id' => $term_id,
                        'set_name'=>$set_name.'',
                        'exam_id' => $exam_id]);
                    $success++;
                } else {
                    $failures++;
                }
            } else {
                $non_existant++;
            }


        }
        // dd($data_big);
        return redirect()->route('confirm')//->with('successMsg', "successfully inserted $success. Errors $failures. student not existing $non_existant")
                         ->with('set_name',$set_name);

    }

    public function confirm()
    {
        $set_name=Session::get('set_name');
        $cancel=$set_name;
        $confirms = ResultUpload::where(['set_name' => $set_name])->get();
        return view('backend.admin.confirm', compact('confirms','set_name','cancel'));
    }



    public function commit( $set_name)
    {

        $results=ResultUpload::where(['set_name'=>$set_name])->get();


        foreach ($results as $result ) {

            $upload = new Result();
            $upload->subject_id = $result->subject_id;
            $upload->student_id = $result->student_id;
            $upload->user_id = $result->user_id;
            $upload->term_id = $result->term_id;
            $upload->exam_id = $result->exam_id;
            $upload->score = $result->score;
            $upload->set_name = $result->set_name;
            $upload->save();


            $result->delete();
        }
            return back()->with('set_name',$set_name)->with('successMsg','Sucessfully commited');



        /* $student = Student::where(['adm_no' => '5456'])->first();
 //        dd($student);
         $file = $request->file('csvfile');
         $subject_id = $request->input('subject_id');
         $exam_id = $request->input('exam_id');
         $term_id = $request->input('term_id');
         $class_id = $request->input('class_id');
         $filepath = $file->getRealPath();
         $file = fopen($filepath, 'r');
         $header = fgetcsv($file);
         $escapeHeader = [];
         foreach ($header as $key => $value) {
             $lheader = strtolower($value);
             $escapeItem = preg_replace('/[^a-z]/', '', $lheader);
             array_push($escapeHeader, $escapeItem);

         }
         //$data_big=[];
         $success = 0;
         $failures = 0;
         $non_existant = 0;
         while ($columns = fgetcsv($file)) {
             if ($columns[0] == "") {
                 continue;
             }


             $data = array_combine($escapeHeader, $columns);
             //['subject_id','score','student_id','user_id','term_id','exam_id'];
             $student = Student::where(['adm_no' => $data['adm']])->first();

             if ($student != null) {
                 $student_id = $student->id;
                 $res = Result::where(['subject_id' => $subject_id,
                     'student_id' => $student_id,
                     'user_id' => Auth::user()->id,
                     'term_id' => $term_id,
                     'exam_id' => $exam_id])->first();
                 if ($res == null) {

                     Result::create(['subject_id' => $subject_id,
                         'score' => $data['score'],
                         'student_id' => $student_id,
                         'user_id' => Auth::user()->id,
                         'term_id' => $term_id,
                         'exam_id' => $exam_id]);
                     $success++;
                 } else {
                     $failures++;
                 }
             } else {
                 $non_existant++;
             }


         }
         // dd($data_big);
         return redirect()->route('confirm')->with('successMsg', "successfully inserted $success. Errors $failures. student not existing $non_existant");
     */



    }


    public function cancelresult($set_name)
    {
        $deletes = ResultUpload:: where(['set_name' => $set_name])->get();

        foreach ($deletes as $delete) {
            $delete->delete();
        }
        return redirect()->route('resultupload')->with('set_name',$set_name);
    }

    public function uncommitted()
    {
        $uncommitteds=ResultUpload::where(['user_id'=>Auth::user()->id])->get();
        return view('backend.admin.uncommitted',compact('uncommitteds'));
    }
    public function downloadresults()
    {

    }

    public function retrieve()
    {   $subjects=Subject::all();
        $darasas=Darasa::all();
        $streams= Stream::all();
        return view('backend.admin.retrieve_results',compact('darasas','streams','subjects'));
    }


}
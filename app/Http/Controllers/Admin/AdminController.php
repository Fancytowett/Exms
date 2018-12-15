<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Darasa;
use App\Exam;
use App\Exports\ResultsExport;
use App\Grade;
use App\Overrallgrade;
use App\Result;
use App\ResultUpload;
use App\Stream;
use App\Stream_Result;
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
use Illuminate\Support\Facades\DB;
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
            'grade'=>'required'

        ]);
        $list_errors=[];
//        $exists=0;
//        $overlap=0;
        $subject_id = $request->input('subject_id');
        foreach ($subject_id as $subject) {
            $min = $request->input('minrange');
            $max = $request->input('maxrange');
            $score = $request->input('grade');
            $score=strtoupper($score);
            $g = Grade::where(['subject_id' => $subject, 'minrange' => $min, 'maxrange' => $max])->exists();
            $x= Grade::where(['subject_id' => $subject,'grade'=>$score])->exists();
            if ($g or $x ) {
                $list_errors[]="Grade exists ";
//           $exists++;
            } else  {

                $latest= Grade::where(['subject_id' => $subject])->latest()->first();

                if($latest==null or ($max==$latest->minrange-1)) {
//                   dd($latest);
                    $grade = new Grade();

                    $grade->subject_id = $subject;
                    $grade->minrange = $min;
                    $grade->maxrange = $max;
                    $grade->grade = $score;
                    $grade->save();
                }else{
//                   $overlap++;
                    $list_errors[]="Overlap of grades";


                }

            }

        }
        $list_errors[]="No error";
        foreach ($list_errors as $error){
            $error;
        }
////        dd($error);
//        if($error!=null){
//            return back()->with("errorMsg","Oops!,Could not Add the Grade ",compact('error'));
//        }else

        return back()->with("successMsg", "Grade successfully added.$error");
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
        $streams=Stream::all();
        return view('backend.admin.add_student_subject', compact('subjects', 'users', 'students','darasas','streams'));
    }

    public function studentsubject_save(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'student_id' => 'required',

        ]);

        $subject_id=$request->input('subject_id');
        $student_id=$request->input('student_id');
        $student=Student::where(['id'=>$student_id])->first();

//        dd($student->class_id);
        foreach ($subject_id as $subject){
            $ss=Student_subject::where([
                'subject_id'=>$subject,
                'class_id'=>$student->class_id,
                'student_id'=>$student->id,
                'stream_id'=>$student->stream_id])
                ->first();

            if ($ss==null)
            {
                Student_subject::create([
                    'subject_id'=>$subject,
                    'user_id'=>Auth::user()->id,
                    'student_id'=>$student->id,
                    'class_id'=>$student->class_id,
                    'stream_id'=>$student->stream_id]);
            }





        }
        return back()->with('successMsg','Successfully assigned');



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

//                dd($res);
                if ($res == null) {
                    DB::enableQueryLog();
                    $grade=DB::select('SELECT `grade` FROM `grades` WHERE ? BETWEEN `minrange`AND`maxrange` AND  subject_id=?',[$data['score'],$subject_id]);

//                               dd($grade[0]->grade);

//                    $queries = DB::getQueryLog();
//                         dd($queries);


                        $upload= new ResultUpload();
                                 $upload->subject_id = $subject_id;
                                 $upload->score =$data['score'];
                                 $upload->student_id = $student_id;
                                 $upload->user_id= Auth::user()->id;
                                 $upload->term_id =$term_id;
                                 $upload-> set_name =$set_name;
                                 $upload->exam_id = $exam_id;
                                 $upload->grade =$grade[0]->grade;
                                 $upload->save();
//                                 dd($upload);
//                        ResultUpload::create([
//                                'subject_id' => $subject_id,
//                                'score' => $data['score'],
//                                'student_id' => $student_id,
//                                'user_id' => Auth::user()->id,
//                                'term_id' => $term_id,
//                                'set_name' => $set_name.'',
//                                'exam_id' => $exam_id,
//                                'grade' => "C"
//                            ]);

                    $success++;
                } else {
                    $failures++;
                }
            } else {
                $non_existant++;
            }


        }
        // dd($data_big);
        return redirect()->route('confirm')
            ->with('successMsg', "successfully inserted $success. Errors $failures. student not existing $non_existant")
            ->with('set_name',$set_name);

    }

    public function confirm()
    {
        $set_name=Session::get('set_name');
        $cancel=$set_name;
        $confirms = ResultUpload::where(['set_name' => $set_name])->get();
        return view('backend.admin.confirm', compact('confirms','set_name','cancel'));
    }
    public function pending()
    {
        $set_name=Session::get('set_name');
        $cancel=$set_name;
        $confirms = ResultUpload::where(['set_name' => $set_name])->get();
        return view('backend.admin.pending_results', compact('confirms','set_name','cancel'));
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
            $upload->grade = $result->grade;
            $upload->set_name = $result->set_name;
            $upload->save();


            $result->delete();
        }
        return back()->with('set_name',$set_name)->with('successMsg','Sucessfully commited');





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
        $uncommitteds=DB::table('result_uploads')
            ->select(['set_name','user_id','subject_id','created_at'])
            ->groupBy('set_name')
            ->get();
//        dd($uncommitteds);
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

    public function stream_result()
    {



        $exams=Exam::all();
        $streams=Stream::all();
        $subjects=Subject::all();

        return view('backend.admin.stream_result',compact('exams','streams','subjects'));
    }

    public function stream_result_save(Request $request)
    {
        $this->validate($request, [
            'stream_id' => 'required',
            'exam_id' => 'required'
        ]);
        $stream_id = $request->input('stream_id');
        $exam_id = $request->input('exam_id');

        $stream = Stream::find($stream_id);

        $students = $stream->students;

        $subjects = Subject::all();
        $results = [];
        $marks=[];
        foreach ($students as $student) {
            $results_1 = Result::where(['exam_id' => $exam_id, 'student_id' => $student->id])->get();
            // dd($results_1);
            $total = 0;

            $data = [];
            foreach ($subjects as $subject) {
                $data[$subject->short_name] = "-";
            }
            // dd($data);
            //$data2=[];
            foreach ($results_1 as $single) {
                $total += $single->score;
                $data[$single->subject->short_name] = $single->score;

            }
            $marks[] = $total;


            $data['names'] = $student->fname . '  ' . $student->lname;
            $data['adm'] = $student->adm_no;
            $data['id'] = $student->id;
            $data['exam_id'] = $exam_id;
            $data['total'] = $total;

            $studentmarks=$total;

            $results[] = $data;
        }
//            dd($studentmarks);
        $exams = Exam::all();
        $streams = Stream::all();
        //  $subjects=Subject::all();
//        foreach ($results as $result){
//            foreach ($result as $key=>$value){
//               var_dump($value);
//            }
//        }
//        dd($student);


        rsort($marks);

        //dd($marks);
        return view('backend.admin.stream_result', compact('exams', 'exam_id','streams', 'subjects', 'results','marks','student','studentmarks'));

        // return back();


    }

    public function classResults(Request $request)
    {
        $this->validate($request, [
            'stream_id' => 'required',
            'exam_id' => 'required'
        ]);
        $stream_id = $request->input('stream_id');
        $exam_id = $request->input('exam_id');

        $streams = Stream::whereIn('id',$stream_id)->get();

        //   dd($streams);



        $subjects = Subject::all();
        $results = [];
        $marks=[];
        foreach($streams as $stream) {
            $students = $stream->students;

            foreach ($students as $student) {
                $results_1 = Result::where(['exam_id' => $exam_id, 'student_id' => $student->id])->get();
                // dd($results_1);
                $total = 0;

                $data = [];
                foreach ($subjects as $subject) {
                    $data[$subject->short_name] = "-";
                }
                // dd($data);
                //$data2=[];
                foreach ($results_1 as $single) {
                    $total += $single->score;
                    $data[$single->subject->short_name] = $single->score;

                }
                $marks[] = $total;


                $data['names'] = $student->fname . '  ' . $student->lname;
                $data['adm'] = $student->adm_no;
                $data['total'] = $total;


                $results[] = $data;
            }
        }

        rsort($marks);
        $exams=Exam::all();

//        dd($results);
        return view('backend.admin.class_results', compact('exams', 'streams', 'subjects', 'results','marks','student','exam_id'));

        // return back();


    }

    public function termview()
    {
        $exams=Exam::all();
        $darasas=Darasa::all();

        return view('backend.admin.student_term_results', compact('exams', 'darasas')) ;

    }

    public function term_results(Request $request)

    {
        $this->validate($request,[
            'exam_ids'=>'required',
            'darasa'=>'required',
        ]);
        $darasas=Darasa::all();
        $exam_ids=$request->input('exam_ids');
        $darasa=$request->input('darasa');
        $subjects = Subject::all();
        $students = Student::where(['class_id'=>$darasa])->get();
        $bigger=[];
        foreach ($students as $student)
        {
            $one_student['details']=$student;
            $all_subjects=[];

            foreach ($subjects as $subject){
                $singe_subject=[];
                foreach ($exam_ids as $exam_id) {
                    $res = Result::where(['exam_id' => $exam_id, 'student_id' => $student->id, 'subject_id' => $subject->id]);
                    if ($res->exists())
                    {
                        $res=$res->first();
                        $singe_subject[]=$res->score;
                    }else{
                        $singe_subject[]=0;
                    }
                }


                $avg=array_sum($singe_subject)/sizeof($singe_subject);

                $singe_subject[]=$avg;

                $all_subjects[$subject->short_name]=$singe_subject;
            }


            $one_student['scores']=$all_subjects;
            $bigger[]= $one_student;
        }
        $exams=Exam::all();
//        dd($bigger);

//        $exam1=$request->input('exam_id');
//        $exam2=$request->input('exam_id');
////        dd($exam2);
//        $exam3=$request->input('exam_id');
////        dd($exam3);
//        $student_id=$request->input('student_id');
//        $subject_id=$request->input('subject_id');
//        $cat1=Result::where(['exam_id'=>$exam1,'student_id'=>$student_id,'subject_id'=>$subject_id])->first();
////        dd($cat1->score);
//        $cat2=Result::where(['exam_id'=>$exam2,'student_id'=>$student_id,'subject_id'=>$subject_id])->first();
//        $main=Result::where(['exam_id'=>$exam3,'student_id'=>$student_id,'subject_id'=>$subject_id])->first();
//        $avcat1=(20/100)*$cat1->score;
//        dd($avcat1);
//        $avcat2=20/100*$cat2->score;
//        $avmain=60/100*$main->score;
//        $result=($avcat1+$avcat2+$avmain);
//        dd($result);
        return view('backend.admin.student_term_results', compact('exams', 'result','streams', 'subjects','exam_id','students','darasas')) ;
    }

    public function class_results ()

    {

        $exams = Exam::all();
        $streams = Stream::all();
        $subjects = Subject::all();

        return view('backend.admin.class_results', compact('exams', 'streams', 'subjects'));
    }

    public function overrallgrades()
    {
        return view('backend.admin.overall_grade');
    }

    public function overrallgrades_save(Request $request)

    {
        $this->validate($request,[
            'minrange'=>'required',
            'maxrange'=>'required',
            'grade'=>'required'

        ]);

        Overrallgrade::create($request->all());

        return back()->with('successMsg','successfully saved');
    }

    public function studentreport(Request $request)
    {
        $this->validate($request, [
            'stream_id' => 'required',
            'exam_id' => 'required',
            'adm_no' => 'required',
        ]);
        $stream_id = $request->input('stream_id');
        $exam_id = $request->input('exam_id');
        $adm = $request->input('adm_no');
        $student_1=Student::where(['adm_no'=>$adm])->first();
        if($student_1==null){
            return back()->with('successMsg','Student does not exist');
        }


        $streams = Stream::whereIn('id',$stream_id)->get();
        $total_1=0;

        $subjects = Subject::all();
        $marks=[];
        foreach($streams as $stream) {
            $students = $stream->students;

            foreach ($students as $student) {
                $results_1 = Result::where(['exam_id' => $exam_id, 'student_id' => $student->id])->get();
                // dd($results_1);
                $total = 0;

                $data = [];
                // dd($data);
                //$data2=[];
                foreach ($results_1 as $single) {
                    $total += $single->score;
                    $data[$single->subject->short_name] = $single->score;
                    if ($single->student_id==$student_1->id)
                        $total_1+=$single->score;

                }
                $marks[] = $total;
                $results[] = $data;


            }
        }



        rsort($marks);
        $exams=Exam::all();
        $position= array_search($total_1, $marks)+1;
        $results= Result::where(['exam_id' => $exam_id, 'student_id' => $student_1->id])->get();
        $student=$student_1;
        $studentmarks=$total_1;
        $size=sizeof($marks);
        $darasas=Darasa::all();
        $streams=Stream::all();
//        dd($position);
        return view('backend.admin.studentreport',compact('results','student','studentmarks','exams','position','size','darasas','streams'));
    }

    public function student_report()
    {
        $exams=Exam::all();
        $streams=Stream::all();
        $darasas=Darasa::all();

        return view('backend.admin.studentreport',compact('exams','darasas','streams'));
    }

}
<?php

namespace App\Http\Controllers\Clerk;

use App\Contact;
use App\Darasa;
use App\Exports\StudentsExport;
use App\Guardian;
use App\Mass_assigment;
use App\Stream;
use App\Student;
use App\Student_subject;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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

    public function uploadstudent()
    {
        $darasas=Darasa::all();
        $streams= Stream::all();
        return view('backend.clerk.studentcsv',compact('darasas','streams'));
    }

    public function studentcsv(Request $request)
    {
           $class=$request->input('class_id');$year=$request->input('year');
           $stream=$request->input('stream_id');
           $file=$request->file('file');
           $filepath=$file->getRealPath();
           $file=fopen($filepath,'r');
           $header=fgetcsv($file);
           $escapeHeader=[];
           foreach ($header as $key=>$value){
               $lheader = strtolower($value);
               $escapeItem = preg_replace('/[^a-z]/', '', $lheader);
               array_push($escapeHeader, $escapeItem);

           }
           while ($columns =fgetcsv($file)) {
               if ($columns[0] == "") {
                   continue;

               }
               $data = array_combine($escapeHeader, $columns);

               $student = Student::where(['adm_no' => $data['adm']])->first();
               if ($student == null) {
                   Student::create([
                       'phone' => $data['phone'],
                       'adm_no' => $data['adm'],
                       'fname' => $data['fname'],
                       'mname' => $data['mname'],
                       'lname' => $data['lname'],
                       'year' => $year,
                       'class_id' => $class,
                       'stream_id' => $stream
                   ]);


               }
           }
               return back()->with('successMsg', 'Students Successfully uploaded');



    }

    public function exportstudents()
    {
        $students=Student::all();
        return view('backend.admin.exportstudents',compact('students'));
    }

    public function downloadstudents(Request $request)
    {
        $class=$request->input('class_id');
        $stream=$request->input('stream_id');
        $now=date('Y_m_d_H_i_s');
        $data=Student::where(['stream_id'=>$stream,'class_id'=>$class])->get();
        $rand=rand(10000,99000);
        $file= fopen(public_path()."/files/".$now."_".$rand ."_file.csv", 'w+');
        fputcsv($file, array('Adm','Names','Score'));
        foreach ($data as $student){
            $s=array($student->adm_no, $student->fname." ".$student->mname, 0);
            fputcsv($file,$s);
        }
        return response()->download(public_path()."/files/".$now."_".$rand ."_file.csv",$now.'_info.csv');
    }
    public function group_mass_assign()
    {
        $subjects = Subject::all();
        $users = User::all();
        $darasas=Darasa::all();
        $streams=Stream::all();
        return view('backend.admin.group_mass_assign', compact('subjects', 'users','darasas','streams'));

    }

    public function groupassign_store(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'stream_id' => 'required',
            'user_id' => 'required',
            'class_id' => 'required',
        ]);
        $stream_id=$request->input('stream_id');
        $class_id=$request->input('class_id');
        $subject_id=$request->input('subject_id');

        //'student_id','subject_id','user_id','class_id','stream_id;
        foreach ($stream_id as $stream)
        {
           $students=Student::where(['stream_id'=>$stream,'class_id'=>$class_id])->get();
           foreach ($students as $student){
               foreach ($subject_id as $subject){
                   $ss=Student_subject::where([
                       'subject_id'=>$subject,
                       'class_id'=>$class_id,

                       'student_id'=>$student->id,
                       'stream_id'=>$stream])
                       ->first();

                   if ($ss==null)
                   {
                       Student_subject::create([
                           'subject_id'=>$subject,
                           'user_id'=>Auth::user()->id,
                           'student_id'=>$student->id,
                           'class_id'=>$class_id,
                           'stream_id'=>$stream]);
                   }

               }

           }

        }
        return back()->with('successMsg','Successfully assigned');
    }


    public function substudents()
    {
        $subjects=Subject::all();
        $darasas=Darasa::all();
        $streams=Stream::all();

        return view('backend.clerk.downloadsubjectstudents',compact('subjects','darasas','streams'));

    }
    public function downloadsubjectstudents(Request $request)
    {
        $class=$request->input('class_id');
        $stream=$request->input('stream_id');
        $subject=$request->input('subject_id');
        $date= date('Y_m_d_H_i_s');
        /*$students=Student_subject::all();
        foreach ($students as $student){
            $student->student()->class_id;
        }*/


        $data=Student_subject::whereIn('stream_id',$stream)
                                 ->where(['subject_id'=>$subject,'user_id'=>Auth::user()->id,'class_id'=>$class])->get();

        $rand=rand(10000,99000);
        $file= fopen(public_path()."/files/".$date."_".$rand ."_file.csv", 'w+');
        fputcsv($file, array('Adm','Names','Score'));
        foreach ($data as $student){
            $s=array($student->student->adm_no, $student->student->fname." ".$student->student->mname, 0);
            fputcsv($file,$s);
        }

        return response()->download(public_path()."/files/".$date."_".$rand ."_file.csv",$date.'_info.csv');

    }

    public function massassignment()
    {
        $streams=Stream::all();
        $subjects=Subject::all();
        $users=User::all();
        $darasas=Darasa::all();
        return view('backend.clerk.subjectmassassignment',compact('users','streams','subjects','darasas'));
    }

    public function mass_save(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required',
            'stream_id' => 'required',
            'user_id' => 'required',
            'class_id' => 'required',
        ]);
        //'student_id','subject_id','user_id','class_id','stream_id'
        $stream= Stream::find($request->input('stream_id'));

        $students=$stream->students;

        foreach ($students as $student) {
            $ss=Student_subject::where(['student_id'=>$student->id,
                                        'subject_id'=>$request->input('subject_id'),
                                        'class_id'=>$request->input('class_id'),
                                        'stream_id'=>$request->input('stream_id')])->first();
            if ($ss==null)
            {
                Student_subject::create(['student_id'=>$student->id,
                    'subject_id'=>$request->input('subject_id'),
                    'user_id'=>1,
                    'class_id'=>$request->input('class_id'),
                    'stream_id'=>$request->input('stream_id')]);
            }

        }
       // Mass_assigment::create($request->all());
        return back()->with('successMsg','Successfully Saved');
    }
}

<?php

namespace App\Http\Controllers\Clerk;

use App\Contact;
use App\Darasa;
use App\Exports\StudentsExport;
use App\Guardian;
use App\Stream;
use App\Student;
use App\Student_subject;
use App\Subject;
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


    public function substudents()
    {
        $subjects=Subject::all();
        $darasas=Darasa::all();

        return view('backend.clerk.downloadsubjectstudents',compact('subjects','darasas'));

    }
    public function downloadsubjectstudents(Request $request)
    {
        $class=$request->input('class_id');
        $subject=$request->input('subject_id');
        $date= date('Y_m_d_H_i_s');
        /*$students=Student_subject::all();
        foreach ($students as $student){
            $student->student()->class_id;
        }*/
        $data=Student_subject::where(['subject_id'=>$subject,'user_id'=>Auth::user()->id,'class_id'=>$class])->get();
//        dd($data);
        $rand=rand(10000,99000);
        $file= fopen(public_path()."/files/".$date."_".$rand ."_file.csv", 'w+');
        fputcsv($file, array('Adm','Names','Score'));
        foreach ($data as $student){
            $s=array($student->student->adm_no, $student->student->fname." ".$student->student->mname, 0);
            fputcsv($file,$s);
        }

        return response()->download(public_path()."/files/".$date."_".$rand ."_file.csv",$date.'_info.csv');

    }
}

<?php

namespace App\Http\Controllers\Clerk;

use App\Guardian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuardianController extends Controller
{
    public function create()
    {
        return view('backend.clerk.add_parent');
    }
    public function store(Request $request)
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
}

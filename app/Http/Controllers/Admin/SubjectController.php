<?php

namespace App\Http\Controllers\Admin;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function create()
    {
        return view('backend.admin.addsubject');

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'short_name'=>'required'


        ]);
        Subject::create($request->all());

        return redirect()->back()->with('successMsg','Subject successfully added');
    }
}

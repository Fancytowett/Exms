<?php

namespace App\Http\Controllers\Admin;
use App\Darasa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function create()
    {
        return view('backend.admin.addclass');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        Darasa::create($request->all());

        return back()->with('SuccessMsg','Class successfully added');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StreamController extends Controller
{
    public function create()
    {
        return view('backend.admin.addstream');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        Stream::create($request->all());
        return back()->with('successMsg','Stream successfully added');
    }
}

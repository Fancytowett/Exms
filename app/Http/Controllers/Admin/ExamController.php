<?php

namespace App\Http\Controllers\Admin;

use App\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function create()
    {
        $streams=Stream::all();
        $
        return view('backend.admin.addexam');
    }

    public function store(Request $request)
    {

    }
}

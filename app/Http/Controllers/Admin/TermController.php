<?php

namespace App\Http\Controllers\Admin;

use App\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{
    public function create()
    {
        return view('backend.admin.addterm');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        Term::create($request->all());

        return back()->with('SuccessMsg','Term successfully added');
        }
}
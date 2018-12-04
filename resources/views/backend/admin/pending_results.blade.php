@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                @if(session('successMsg'))
                    <div class="alert alert-success">
                        {{session('successMsg')}}
                    </div>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h2>Results</h2>
                        <div class="row">
                            <div class="col-md-6">
                                {{--<a href="{{route('commit',$set_name)}}" class="btn btn-sm btn-primary"> Commit</a>--}}
                                {{--<a href="{{route('cancel',$cancel)}}" class="btn btn-sm btn-danger"> Cancel</a>--}}

                            </div>
                            <div class="col-md-6">


                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Student </th>
                                <th>Subject</th>
                                <th>Score</th>
                                <th>Term</th>
                                <th>Exam</th>
                                <th>Teacher</th>
                            </tr>
                            @foreach($confirms as $confirm)
                                <tr>
                                    <td>{{$confirm->student->fname." ".$confirm->student->mname." ".$confirm->student->lname}}</td>
                                    <td>{{$confirm->subject->name}}</td>
                                    <td>{{$confirm->score}}</td>
                                    <td>{{$confirm->term->name}}</td>
                                    <td>{{$confirm->exam->name}}</td>
                                    <td>{{Auth::user()->name}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
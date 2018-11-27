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
                                <a href="{{route('confirm')}}" class="btn btn-sm btn-primary"> More Details</a>

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
                            @foreach($uncommitteds as $uncommitted)
                                <tr>
                                    <td>{{$uncommitted->student->fname." ".$uncommitted->student->mname." ".$uncommitted->student->lname}}</td>
                                    <td>{{$uncommitted->subject->name}}</td>
                                    <td>{{$uncommitted->score}}</td>
                                    <td>{{$uncommitted->term->name}}</td>
                                    <td>{{$uncommitted->exam->name}}</td>
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
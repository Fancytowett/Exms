@extends('layouts.app')
@section('content')
    <div class="container -fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <a href="{{route('download')}}" class="btn btn-success">Download</a>
                <div class="card">
                    <div class="card-header">
                        <h2>Students</h2>
                    </div>
                    <div class="card-body">
                        <table class=" table table-striped">
                            <tr>
                                <th>id</th>
                                <th>Phone</th>
                                <th>Fname</th>
                                <th>Mname</th>
                                <th>Lname</th>
                                <th>Year</th>
                                <th>Class_id</th>
                                <th>Stream_id</th>
                                <th>Adm_no</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                            </tr>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->phone}}</td>
                                    <td>{{$student->fname}}</td>
                                    <td>{{$student->mname}}</td>
                                    <td>{{$student->lname}}</td>
                                    <td>{{$student->year}}</td>
                                    <td>{{$student->class_id}}</td>
                                    <td>{{$student->stream->id}}</td>
                                    <td>{{$student->adm_no}}</td>
                                    <td>{{$student->created_at}}</td>
                                    <td>{{$student->updated_at}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
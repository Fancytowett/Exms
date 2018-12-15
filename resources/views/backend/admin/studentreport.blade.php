@extends('layouts.app')
@section('content')
    <div class="contiainer-fluid">
        <div class="row justify-content-center">
            <form class="form-inline mb-4 float-left" action="{{route('studentreport')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="adm" class="mr-sm-2">Admission No:</label>
                    <input type="text" class="form-control mr-sm-2" name="adm_no" placeholder="Enter Student Adm No" >
                </div>

                <div class="form-group">
                    <label for="exam" class="mr-sm-2"> Exam</label>
                    <select class="form-control mr-5" name="exam_id">
                        @foreach($exams as $exam)
                            <option value="{{$exam->id}}"> {{$exam->name." ".$exam->class->name." ".$exam->year." ".$exam->term->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('exam_id'))
                        <p class="text-danger">{{$errors->first('exam_id')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="class" class="mr-sm-2">Form</label>
                    <select name="class_id" class="form-control">
                        @foreach($darasas as $darasa)
                            <option value="{{$darasa->id}}">{{$darasa->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="stream" class="mr-sm-3">stream</label>
                    @foreach($streams as $stream)
                        <div class="checkbox">
                            <label><input type="checkbox" name="stream_id[]" class="ml-3" value="{{$stream->id}}"
                                       checked> {{$stream->name}}</label>
                        </div>

                    @endforeach

                    @if($errors->has('stream_id'))
                        <p class="text-danger">{{$errors->first('stream_id')}}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-success ml-2">View</button>
            </form>
            @if(isset($student))
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">STUDENT REPORT</h3>
                        <h4 class="text-center">{{$student->fname." ".$student->mname}}</h4>
                        <h5 class="text-center">Admission Number: {{$student->adm_no}}</h5>
                    </div>
                    <div class="card-body">
                        <table class=" table table-bordered">
                            <tr>
                                <th>Subjects</th>
                                <th>Teacher</th>
                                <th>Score</th>
                                <th>Grade</th>
                                <th>Comments</th>
                                <th></th>
                            </tr>

                            @foreach($results as $result)
                                <tr>
                                    <td>{{$result->subject->short_name}}</td>
                                    <td>{{$result->user->name}}</td>
                                    <td>{{$result->score}}</td>

                                    {{--<td>{{$student->}}</td>--}}
                                    {{--<td>{{$student->score}}</td>td--}}
                                </tr>

                            @endforeach
                            <tr>
                                <td>Total Marks</td>
                                <td>{{$studentmarks}}</td>
                                <td>Position</td>
                                <td>{{$position}}/{{$size}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            @endif
        </div>

    </div>

@endsection
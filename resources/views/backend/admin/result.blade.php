@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                @if(session('successMsg'))
                    <div class="alert alert-success">
                        {{session('successMsg')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center"> Results Details</h2>
                    </div>


                    <div class="card-body">
                        <form action="{{route('result.save')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="form"> Student</label>
                                <select class="form-control" name="student_id">
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}"> {{$student->fname." ".$student->lname." ".$student->mname."/".$student->adm_no}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('student_id'))
                                    <p class="text-danger">{{$errors->first('student_id')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="form"> Subject</label>
                                <select class="form-control" name="subject_id">
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}"> {{$subject->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('subject_id'))
                                    <p class="text-danger">{{$errors->first('subject_id')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="score">Score</label>
                                <input type="number" class="form-control" name="score" placeholder="Score">
                                @if($errors->has('score'))
                                    <p class="text-danger">{{$errors->first('score')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="form"> Exam</label>
                                <select class="form-control" name="exam_id">
                                    @foreach($exams as $exam)
                                        <option value="{{$exam->id}}"> {{$exam->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('exam_id'))
                                    <p class="text-danger">{{$errors->first('exam_id')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="form"> Term</label>
                                <select class="form-control" name="term_id">
                                    @foreach($terms as $term)
                                        <option value="{{$term->id}}"> {{$term->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('term_id'))
                                    <p class="text-danger">{{$errors->first('term_id')}}</p>
                                @endif
                            </div>



                            <div class="form-group">
                                <label for="teacher">Teacher</label>
                                <select name="user_id" id="" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach

                                </select>
                                @if($errors->has('user_id'))
                                    <p class="text-danger">{{$errors->first('user_id')}}</p>
                                @endif
                            </div>


                            <button type="submit" class="btn btn-block btn-primary">Add</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
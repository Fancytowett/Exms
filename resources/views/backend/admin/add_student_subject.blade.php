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
                        <h2 class="text-center"> Student Subject  </h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('studentsubject.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Students:</label>
                                <select name="student_id" class="form-control">
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}">{{$student->fname." ".$student->mname." Adm:".$student->adm_no}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('subject'))
                                    <p class="text-danger">{{$errors->first('subject')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Subject:</label>
                                <div class="checkbox" >
                                    @foreach($subjects as $subject)
                                      <label> <input type="checkbox"  name="subject_id[]"  value="{{$subject->id}}">{{$subject->name}}</label><br>
                                    @endforeach
                            </div>
                                @if($errors->has('subject_id'))
                                    <p class="text-danger">{{$errors->first('subject_id')}}</p>
                                @endif
                            </div>





                            <button type="submit" class="btn btn-block btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
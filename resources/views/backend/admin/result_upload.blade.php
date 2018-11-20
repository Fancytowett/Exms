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
                        <h2 class="text-center"> Results Upload</h2>
                    </div>


                    <div class="card-body">
                        <form action="{{route('upload.save')}}" method="post" enctype="multipart/form-data">
                            @csrf
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
                                <label for="form"> Term</label>
                                <select class="form-control" name="class_id">
                                    @foreach($darasas as $darasa)
                                        <option value="{{$darasa->id}}"> {{$darasa->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('class_id'))
                                    <p class="text-danger">{{$errors->first('class_id')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="file">Result upload</label>
                                <input type="file" name="csvfile">
                                @if($errors->has('csvfile'))
                                    <p class="text-danger">{{$errors->first('csvfile')}}</p>
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
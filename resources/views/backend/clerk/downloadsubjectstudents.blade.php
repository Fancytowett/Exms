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
                        <form action="{{route('subjectstudents')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Subject:</label>
                                <select name="subject_id" class="form-control">
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('subject'))
                                    <p class="text-danger">{{$errors->first('subject')}}</p>
                                @endif
                            </div><div class="form-group">
                                <label for="form"> Form</label>
                                <select class="form-control" name="class_id">
                                    @foreach($darasas as $darasa)
                                        <option value="{{$darasa->id}}"> {{$darasa->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('class_id'))
                                    <p class="text-danger">{{$errors->first('class_id')}}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-block btn-primary">Download</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
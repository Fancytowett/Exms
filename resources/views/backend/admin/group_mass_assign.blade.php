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
                        <h2 class="text-center"> Assign Subjects </h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('groupassign.store')}}" method="post">
                            @csrf

                            <div class="form-group">
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
                            <div class="form-group">
                                <label for="stream" class="mr-sm-2">stream</label>
                                @foreach($streams as $stream)
                                    <div class="form-check-inline">
                                        <label><input type="checkbox" name="stream_id[]" class="ml-3" value="{{$stream->id}}"
                                                      checked> {{$stream->name}}</label>
                                    </div>
                                @endforeach

                                @if($errors->has('stream_id'))
                                    <p class="text-danger">{{$errors->first('stream_id')}}</p>
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

                            <div class="form-group">
                                <label for="name">Teacher:</label>
                                <select name="user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user_id'))
                                    <p class="text-danger">{{$errors->first('user_id')}}</p>
                                @endif
                            </div>



                            <button type="submit" class="btn btn-block btn-primary">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
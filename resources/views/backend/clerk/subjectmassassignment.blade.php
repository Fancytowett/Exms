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
                        <form action="{{route('mass.save')}}" method="post">
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
                                    <label for="stream">stream</label>
                                    <select name="stream_id" id="" class="form-control">
                                        @foreach($streams as $stream)
                                            <option value="{{$stream->id}}">{{$stream->name}}</option>
                                        @endforeach

                                    </select>
                                    @if($errors->has('stream_id'))
                                        <p class="text-danger">{{$errors->first('stream_id')}}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="form"> Teacher</label>
                                    <select class="form-control" name="user_id">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"> {{$user->name}}</option>
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
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
                        <h2 class="text-center">Subject Teacher </h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('subjectteacher.store')}}" method="post">
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
                            <div class="form-group">
                                <label for="name">Form:</label>
                                <select name="darasa_id" class="form-control">
                                    @foreach($darasas as $darasa)
                                        <option value="{{$darasa->id}}">{{$darasa->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('darasa_id'))
                                    <p class="text-danger">{{$errors->first('darasa_id')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Stream:</label>
                                <select name="stream_id" class="form-control">
                                    @foreach($streams as $stream)
                                        <option value="{{$stream->id}}">{{$stream->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('stream_id'))
                                    <p class="text-danger">{{$errors->first('stream_id')}}</p>
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
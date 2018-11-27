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
                        <h2 class="text-center"> Student Details</h2>
                    </div>


                    <div class="card-body">
                        <form action="{{route('studentcsv')}}" method="post" enctype="multipart/form-data">
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
                                <label for="year">Year</label>
                                <input type="number" class="form-control" name="year" placeholder="Year">
                                @if($errors->has('year'))
                                    <p class="text-danger">{{$errors->first('year')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="file">Student File</label>
                                <input type="file"name="file" >
                                @if($errors->has('file'))
                                    <p class="text-danger">{{$errors->first('file')}}</p>
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
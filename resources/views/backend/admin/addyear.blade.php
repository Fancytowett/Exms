@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
           <div class="col-6">
               <div class="card">
                   @if(session('SuccessMsg'))
                       <div class="alert alert-success">
                           {{session('SuccessMsg')}}
                       </div>
                   @endif
                   <div class="card-header">
                       <h2 class="text-center">Year's Details</h2>

                   </div>
                   <form action="{{route('year.store')}}" method="post">
                       @csrf
                   <div class="card-body">
                       <div class="form-group">
                           <label>Year:</label>
                           <input type="number" name="year" class="form-control">
                           @if($errors->has('year'))
                               <p class="text-danger">{{$errors->first('year')}}</p>
                               @endif
                       </div>
                       <div class="form-group">
                           <label>Form:</label>
                           <select name="class" class="form-control">
                               @foreach($darasas as $darasa)
                               <option value="{{$darasa->id}}">{{$darasa->name}}</option>
                                   @endforeach

                           </select>@if($errors->has('class'))
                               <p class="text-danger">{{$errors->first('class')}}</p>
                           @endif
                       </div>
                       <div class="form-group">
                           <label>Term:</label>
                           <select name="term" class="form-control">
                               <option value="1">Term One</option>

                           </select>
                           @if($errors->has('term'))
                               <p class="text-danger">{{$errors->first('term')}}</p>
                           @endif
                       </div>
                       <div class="form-group">
                           <label>Exam name:</label>
                           <select name="exam_id" class="form-control">
                               @foreach($exams as $exam)
                                   <option value="{{$exam->id}}">{{$exam->name}}</option>
                                   @endforeach
                           </select>
                               @if($errors->has('term'))
                                   <p class="text-danger">{{$errors->first('exam_name')}}</p>
                               @endif

                       </div>
                       <div class="form-group">
                           <label>Stream name:</label>
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
                   </div>
                   </form>
               </div>
           </div>
        </div>
    </div>
    @endsection
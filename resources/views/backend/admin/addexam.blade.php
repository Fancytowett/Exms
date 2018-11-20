@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                @if(session('SuccessMsg'))
                    <div class="alert alert-success">
                        {{session('SuccessMsg')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Exam Details</h2>
                    </div>

                        <div class="card-body">
                            <form action="{{route('exam.store')}}" method="post">
                                @csrf
                            <div class="form-group">
                                <label>Exam name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Exam name">
                                @if($errors->has('name'))
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                @endif
                            </div>

                        <div class="form-group">
                            <label>Year:</label>
                            <input type="number" name="year" class="form-control">
                            @if($errors->has('year'))
                                <p class="text-danger">{{$errors->first('year')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Form:</label>
                            <select name="class_id" class="form-control">
                                @foreach($darasas as $darasa)
                                    <option value="{{$darasa->id}}">{{$darasa->name}}</option>
                                @endforeach

                            </select>
                            @if($errors->has('class_id'))
                                <p class="text-danger">{{$errors->first('class_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Term:</label>
                            <select name="term_id" class="form-control">
                                @foreach($terms as $term)
                                    <option value="{{$term->id}}">{{$term->name}}</option>
                                @endforeach

                            </select>
                            @if($errors->has('term_id'))
                                <p class="text-danger">{{$errors->first('term_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-block btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
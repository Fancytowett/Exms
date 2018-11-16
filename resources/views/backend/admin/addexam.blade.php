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
                        <h2 class="text-center">Class Details</h2>
                    </div>

                        <div class="card-body">
                            <form action="{{route('class.store')}}" method="post">
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
                            <select name="class" class="form-control">
                                <option value="1">Form One</option>
                                <option value="2">Form Two</option>
                                <option value="3">Form Three</option>
                                <option value="4">Form Four</option>
                            </select>@if($errors->has('class'))
                                <p class="text-danger">{{$errors->first('class')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Term:</label>
                            <select name="term" class="form-control">
                                <option value="1">Term One</option>
                                <option value="2">Term Two</option>
                                <option value="3">Term Three</option>
                            </select>
                            @if($errors->has('term'))
                                <p class="text-danger">{{$errors->first('term')}}</p>
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
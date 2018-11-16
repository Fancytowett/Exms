@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                @if(session('SuccessMsg'))
                    <div class="alert alert-success">
                        {{session('successMsg')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center"> Student Details</h2>
                    </div>


                    <div class="card-body">
                        <form action="{{route('student.add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="adm_no">Adm_no</label>
                                <input type="text" class="form-control" name="adm_no" placeholder="Admission Number">
                                @if($errors->has('adm_no'))
                                    <p class="text-danger">{{$errors->first('adm_no')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="f_name">First Name:</label>
                                <input type="text" class="form-control" name="fname" placeholder="First Name">
                                @if($errors->has('fname'))
                                    <p class="text-danger">{{$errors->first('fname')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="m_name">Middle Name:</label>
                                <input type="text" class="form-control" name="mname" placeholder="Middle Name">
                                @if($errors->has('mname'))
                                    <p class="text-danger">{{$errors->first('mname')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="l_name">Last Name:</label>
                                <input type="text" class="form-control" name="lname" placeholder=" Last Name">
                                @if($errors->has('lname'))
                                    <p class="text-danger">{{$errors->first('flname')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="form"> Form</label>
                                <select class="form-control" name="class">
                                    <option value="1">Form One</option>
                                    <option value="2">Form Two</option>
                                    <option value="3">Form Three</option>
                                    <option value="4">Form Four</option>
                                </select>
                                @if($errors->has('class'))
                                    <p class="text-danger">{{$errors->first('class')}}</p>
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

                            <button type="submit" class="btn btn-block btn-primary">Add</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
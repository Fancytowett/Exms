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
                        <h2 class="text-center">Guardian Details</h2>
                    </div>

                    <div class="card-body">

                        <form action="{{route('guardian.add')}}" method="post">
                         @csrf
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
                                    <p class="text-danger">{{$errors->first('lname')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="student_id">Student Admisson_no</label>
                                <input type="number" class="form-control" name="stud_adm_no" placeholder=" student admission no.">
                                @if($errors->has('lname'))
                                    <p class="text-danger">{{$errors->first('lname')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone1">Phone Number 1</label>
                                <input type="number" class="form-control" name="phone1" placeholder="Phone Number">
                                @if($errors->has('phone1'))
                                    <p class="text-danger">{{$errors->first('phone1')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone2">Phone Number 2</label>
                                <input type="number" class="form-control" name="phone2" placeholder="Phone Number">
                                @if($errors->has('phone2'))
                                    <p class="text-danger">{{$errors->first('phone2')}}</p>
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
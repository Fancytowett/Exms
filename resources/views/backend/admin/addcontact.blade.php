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
                        <h2 class="text-center">Add Contact </h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('contact.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" placeholder=" Name">
                                @if($errors->has('name'))
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                @endif
                            </div><div class="form-group">
                                <label for="name">Phone Number:</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                @if($errors->has('phone'))
                                    <p class="text-danger">{{$errors->first('phone')}}</p>
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
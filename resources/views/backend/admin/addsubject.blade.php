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
                        <h2>Add Subject</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('add.subject')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Subject Name">
                                @if($errors->has('name'))
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Short Name:</label>
                                <input type="text" name="short_name" class="form-control" placeholder="Subject short Name">
                                @if($errors->has('short_name'))
                                    <p class="text-danger">{{$errors->first('short_name')}}</p>
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
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
                        <h2 class="text-center">Overall Grades </h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route('overrallgrades.store')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="Minrange">Min Range:</label>
                                <input type="number" name="minrange" class="form-control" placeholder="Minimum Range">
                                @if($errors->has('minrange'))
                                    <p class="text-danger">{{$errors->first('minrange')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Maxrange">Maximum Range:</label>
                                <input type="number" name="maxrange" class="form-control" placeholder="Maximum Range">
                                @if($errors->has('maxrange'))
                                    <p class="text-danger">{{$errors->first('maxrange')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Minrange">Grade:</label>
                                <input type="text" name="grade" class="form-control" placeholder=" Grade">
                                @if($errors->has('grade'))
                                    <p class="text-danger">{{$errors->first('grade')}}</p>
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
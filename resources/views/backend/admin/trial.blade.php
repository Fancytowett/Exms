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
                        <h2 class="text-center"> Results Upload</h2>
                    </div>


                    <div class="card-body">
                        <form action="{{route('upload.save')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input type="file" name="csvfile">
                                @if($errors->has('csvfile'))
                                    <p class="text-danger">{{$errors->first('csvfile')}}</p>
                                @endif
                            </div>


                            <button type="submit" class="btn  btn-primary">Commit</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
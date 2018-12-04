@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                @if(session('successMsg'))
                    <div class="alert alert-success">
                        {{session('successMsg')}}
                    </div>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h2> Uncommitted Results</h2>

                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Date uploaded </th>
                                <th>Set_name</th>
                                <th>Subject</th>
                                <th>Uploaded By</th>
                                <th>Action</th>

                            </tr>
                            @foreach($uncommitteds as $uncommitted)
                                <tr>
                                    <td>{{$uncommitted->created_at}}</td>
                                    <td>{{$uncommitted->set_name}}</td>
                                    <td>{{$uncommitted->subject_id}}</td>
                                    <td>{{$uncommitted->user_id}}</td>
                                    <td><a href="{{route('commit',$uncommitted->set_name)}}" class="btn btn-sm btn-success">Commit</a> </td>
                                    <td><a href="{{route('cancel',$uncommitted->set_name)}}" class="btn btn-sm btn-danger">Cancel </a></td>
                                    <td></td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
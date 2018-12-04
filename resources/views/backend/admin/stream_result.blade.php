@extends('layouts.app')
@section('extras')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">

                @if(session('successMsg'))
                    <div class="alert alert-success">
                        {{session('successMsg')}}
                    </div>
                @endif
                <form class="form-inline mb-4 float-left" action="{{route('streamresults.display')}}" method="post">
                    @csrf


                    <div class="form-group">
                        <label for="exam" class="mr-sm-2"> Exam</label>
                        <select class="form-control mr-5" name="exam_id">
                            @foreach($exams as $exam)
                                <option value="{{$exam->id}}"> {{$exam->name." ".$exam->class->name." ".$exam->year." ".$exam->term->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('exam_id'))
                            <p class="text-danger">{{$errors->first('exam_id')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="stream" class="mr-sm-2">stream</label>
                        @foreach($streams as $stream)
                            <div class="radio">
                                <label><input type="radio" name="stream_id" class="ml-3" value="{{$stream->id}}"
                                              checked> {{$stream->name}}</label>
                            </div>
                        @endforeach

                        @if($errors->has('stream_id'))
                            <p class="text-danger">{{$errors->first('stream_id')}}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success ml-2">View</button>
                </form>
                @if(isset($results))
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Names</th>
                            <th>Adm_no</th>

                            @foreach($subjects as $subject)
                                <th>{{$subject->short_name}}</th>
                            @endforeach
                            <th>Total Marks</th>
                            <th>Position</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($results as $result)
                            <tr>

                                <td>{{$result["names"]}}</td>
                                <td>{{$result["adm"]}}</td>
                                @foreach($result as $key=>$value)

                                    @php

                                        if ($key !="names" and $key!="adm")
                                        {
                                        echo ' <td>';
                                          echo($result[$key]);
                                        echo' </td>';
                                        }

                                    @endphp


                                @endforeach

                                <td>
                                    {{ array_search($result['total'], $marks)+1 }}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>


                    </table>
                @endif
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            //$('#myTable').DataTable();
            $('#myTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );

        });
    </script>
@endsection

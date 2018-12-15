@extends('layouts.app')
@section('extras')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

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
                <form class="form mb-4 float-left" action="{{route('studentterm.results')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="form">Class</label>
                        <select class="form-control" name="darasa">
                            @foreach($darasas as $darasa)
                                <option value="{{$darasa->id}}"> {{$darasa->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label id="check" for="form">Exams</label>

                        @foreach($exams as $exam)
                            <div class="checkbox" >
                                <label> <input id="check" data-toggle="modal" data-target="#myModal" type="checkbox" name="exam_ids[]" value="{{$exam->id}}">{{$exam->name}}</label>

                            </div>
                        @endforeach

                    </div>

                    <button type="submit" class="btn btn-success ml-2">View</button>
                </form>
                @if(isset($result))
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Score</th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
{{--                            <td>{{$result}}</td>--}}

                        </tr>
                        </tbody>


                    </table>
                @endif
                    <h2>Modal Example</h2>
                    <!-- Button to Open the Modal -->

                    <div id="result">

                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Marks Percentage</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="email">Percent:</label>
                                        <input type="number" class="form-control" id="per">
                                    </div>                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"  id="buttonCloseID" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                        </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            // $('#myTable').DataTable();
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

        });

            $(document).ready(function () {
                $('#checkbox').click(function () {

                });
                $('#buttonCloseID ').click(function () {
                    var databack=$("#myModal #per").val().trim();

                    $('#check').html(databack);
                }) ;
            });

    </script>
@endsection

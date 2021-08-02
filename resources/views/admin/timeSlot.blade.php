@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Guest') }}</div>

                <div class="m-5">
                    <style>
                        table th{
                            text-transform: capitalize;
                        }
                        table tbody tr{
                            cursor: pointer;
                            -webkit-transition: 0.3s ;
                            -moz-transition: 0.3s ;
                            -ms-transition: 0.3s ;
                            -o-transition: 0.3s ;
                            transition: 0.3s ;
                        }
                        table tbody tr:hover{
                            background: #4f565e;
                        }



                    </style>
                    <script>
                        function display_TimeSlot(anchor){
                            window.location.href = '/timeSlot/'+anchor;
                        }


                        function anchor(anchor, lien){
                            window.location.href = lien+anchor;
                        }
                    </script>

                    <table class="table table-bordered">
                        <thead>
                        <tr  scope="row">
                            <th>ID</th>
                            <th>Start Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(true)
                                <tr class="pointer">
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->idTimeSlot}}</td>
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->startDateTimeSlot}}</td>
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->reasonTimeSlot}}</td>
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->status->labelStatus}}</td>
                                    <td>
                                        <a href="{{url('/deleteTimeSlot/'.$timeSlot->idTimeSlot)}}" class="btn btn-danger">supp</a>
                                        <a href="{{url('/modifyTimeSlot/'.$timeSlot->idTimeSlot)}}" class="btn btn-success">modify</a>
                                    </td>
                                </tr>
                        @else
                            <td>error</td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

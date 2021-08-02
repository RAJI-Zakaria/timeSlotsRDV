@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Guest') }}</div>

                <div class="m-5">

                    <script>
                        function display_TimeSlot(anchor){
                            window.location.href = 'timeSlot/'+anchor;
                        }


                        function anchor(anchor, lien){
                            window.location.href = lien+anchor;
                        }
                    </script>

                    <h2>Nombre de reservations est {{sizeof($timeSlots)}}</h2>
                    <table class="table table-bordered">
                        <thead>
                        <tr  scope="row">
                            <th>Confirm</th>
                            <th>ID</th>
                            <th>Start Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(true)
                            @foreach($timeSlots as $timeSlot)
                                <tr class="pointer">
                                    <td><input onclick="anchor({{$timeSlot->idTimeSlot}},'/ChangeTimeSlotStatus/')" type="checkbox" name="timeSlotStatus" {{($timeSlot->idStatus==2)?"checked":""}}></td>
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->idTimeSlot}}</td>
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->startDateTimeSlot}}</td>
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->reasonTimeSlot}}</td>
                                    <td onclick="display_TimeSlot({{$timeSlot->idTimeSlot}})">{{$timeSlot->status->labelStatus}}</td>
                                    <td>
                                        <a href="{{url('/modifyTimeSlot/'.$timeSlot->idTimeSlot)}}" class="btn btn-success">mod</a>
                                    </td>
                                </tr>
                            @endforeach
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

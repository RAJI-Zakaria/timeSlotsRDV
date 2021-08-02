@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Guest') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                        <br>
                        Name : {{ Auth::user()->namePerson }}
                        <br>
                        Email : {{ Auth::user()->emailPerson }}
                        <br><br>
                        <a href="{{route('Guest-TimeSlots')}}" class="btn btn-success">Show Time Slots List</a>

                        <a href="{{route('TimeSlot.create')}}" class="btn btn-success">Create Time Slot</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

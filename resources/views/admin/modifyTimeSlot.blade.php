@extends('../layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard aDmin') }}</div>

                    <div class="m-5">
                        @if($errors->any())
                            <div class="alert alert-warning">{{$errors->first()}}</div>
                        @endif

                        <form method="POST" action="{{ route('TimeSlot.update') }}">
                            @csrf
                            <div class="form-group row">
                                <input name="idTimeSlot" value="{{$timeSlot->idTimeSlot}}" type="hidden">

                                <label for="startDateTimeSlot" class="col-md-4 col-form-label text-md-right">{{ __('startDateTimeSlot') }}</label>
                                <div class="col-md-6">
                                    <input id="startDateTimeSlot" type="datetime"  placeholder="2021-08-01 16:12:00" class="form-control @error('startDateTimeSlot') is-invalid @enderror" name="startDateTimeSlot" value="{{$timeSlot->startDateTimeSlot}}" required autocomplete="startDateTimeSlot" autofocus>

                                    @error('dateVisite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reasonTimeSlot" class="col-md-4 col-form-label text-md-right">{{ __('Motif') }}</label>

                                <div class="col-md-6">
                                    <input id="reasonTimeSlot" type="text" class="form-control @error('reasonTimeSlot') is-invalid @enderror" name="reasonTimeSlot" value="{{$timeSlot->reasonTimeSlot}}" required autocomplete="reasonTimeSlot">

                                    @error('reasonTimeSlot')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="statusTimeSlot" class="col-md-4 col-form-label text-md-right">{{ __('statusTimeSlot') }}</label>

                                <div class="col-md-6">
                                    <input id="statusTimeSlot" disabled type="text"  class="form-control @error('statusTimeSlot') is-invalid @enderror" name="statusTimeSlot" value="{{$timeSlot->status->labelStatus}}">

                                    @error('statusTimeSlot')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Modify') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

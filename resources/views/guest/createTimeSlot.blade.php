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
                            .pointer{
                                cursor: pointer;
                            }
                            table tbody tr{
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
                            function displayById(anchor){
                                window.location.href = '/medicament/'+anchor;
                            }

                        </script>
                        @if($errors->any())
                            <div class="alert alert-warning">{{$errors->first()}}</div>
                        @endif

                        <form method="POST" action="{{ route('TimeSlot.store') }}">
                            @csrf
                            <div class="form-group row">
{{--                                <input name="idTimeSlot" value="{{}}" type="hidden">--}}

                                <label for="startDateTimeSlot" class="col-md-4 col-form-label text-md-right">{{ __('startDateTimeSlot') }}</label>
                                <div class="col-md-6">
                                    <input id="startDateTimeSlot" type="datetime"  placeholder="2021-08-01 16:12:00" class="form-control @error('startDateTimeSlot') is-invalid @enderror" name="startDateTimeSlot" value="" required autocomplete="startDateTimeSlot" autofocus>

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
                                    <input id="reasonTimeSlot" type="text" class="form-control @error('reasonTimeSlot') is-invalid @enderror" name="reasonTimeSlot" value="Reasons?" required autocomplete="reasonTimeSlot">

                                    @error('motifTimeSlot')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="statusTimeSLot" class="col-md-4 col-form-label text-md-right">{{ __('statusTimeSLot') }}</label>

                                <div class="col-md-6">
                                    <input id="statusTimeSLot" disabled type="text"  class="form-control @error('statusTimeSLot') is-invalid @enderror" name="statusTimeSLot" value="Default">

                                    @error('dateProchainVisite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add') }}
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

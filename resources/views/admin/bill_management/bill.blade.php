@extends('layouts.app')
@section('content')
<div class="container">

    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ __('adm_messages.bill_new') }}</h4>
                <div class="card-body">
                     {{ Form::open(['action' => ['BillController@setBills']]) }}

                     <div class="form-group">
                            {{ Form::label('date', __('adm_messages.month'), ['class' => 'control-label']) }}
                            {{ Form::month('date', \Carbon\Carbon::now()) }}
                             @if ($errors->has('date'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                    </div>
                     
                    <div class="form-group">
                            {{ Form::label('admsummeter', __('adm_messages.ac_per_m2'), ['class' => 'control-label']) }}
                            {{ Form::text('admsummeter', '', ['class' => 'form-control', 'id' => 'admsummeter'])}} 
                             @if ($errors->has('admsummeter'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('admsummeter') }}
                                </div>
                            @endif
                    </div>
                     
                     <div class="form-group">
                            {{ Form::label('admsum', __('Cost per m2'), ['class' => 'control-label']) }}
                            {{ Form::text('admsum', '', ['class' => 'form-control', 'id' => 'admsum'])}} 
                             @if ($errors->has('admsum'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('admsum') }}
                                </div>
                            @endif
                    </div>
                     
                     <div class="form-group">
                            {{ Form::label('cold', __('Cold water per m3'), ['class' => 'control-label']) }}
                            {{ Form::text('cold', '', ['class' => 'form-control', 'id' => 'cold'])}} 
                             @if ($errors->has('cold'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('cold') }}
                                </div>
                            @endif
                    </div>
                     
                    <div class="form-group">
                            {{ Form::label('hot', __('Hot water per m3'), ['class' => 'control-label']) }}
                            {{ Form::text('hot', '', ['class' => 'form-control', 'id' => 'hot'])}} 
                             @if ($errors->has('hot'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('hot') }}
                                </div>
                            @endif
                    </div>
                     
                    <div class="form-group">
                            {{ Form::label('heat', __('Heating per unit'), ['class' => 'control-label']) }}
                            {{ Form::text('heat', '', ['class' => 'form-control', 'id' => 'heat'])}} 
                             @if ($errors->has('heat'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('heat') }}
                                </div>
                            @endif
                    </div>

                     
                     
                    
                      {{ Form::submit(__('adm_messages.bill_create'), ['class' => 'btn btn-primary'])}}
                     {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


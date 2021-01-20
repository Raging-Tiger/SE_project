@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ __('adm_messages.fine_add_new') }}</h4>
                <div class="card-body">
                    
        
           {{ __('adm_messages.fname') }}: {{$inh -> name }} {{$inh -> surname }}
            {{ __('adm_messages.pk') }}: {{$inh -> personal_code }}
        
        
        
        <br>
        <br>
        
       {{ Form::open(['action' => ['FineController@setFine']]) }}
                {{ Form::hidden('inhid', $inh->id, ['class' => 'inhid', 'id' => 'inhid'])}}
                
                <div class="form-group">
                           {{ Form::label('status', __('adm_messages.reason'), ['class' => 'control-label']) }}
                           {{ Form::select('status', $status , null, ['placeholder' => 'Select a reason'])}}
                            @if ($errors->has('status'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                </div>
                
                <div class="form-group">
                           {{ Form::label('fsum', __('adm_messages.sum_left'), ['class' => 'control-label']) }}
                           {{ Form::text('fsum', '', ['class' => 'form-control', 'id' => 'fsum'])}} 
                            @if ($errors->has('fsum'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fsum') }}
                                </div>
                            @endif
                </div>
                {{ Form::submit(__('adm_messages.fine_add'), ['class' => 'btn btn-primary'])}}
       {{ Form::close() }}
        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

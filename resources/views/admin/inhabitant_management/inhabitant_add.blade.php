@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{__("adm_messages.add_inh") }}</h4>
                <div class="card-body">
                    {{ Form::open(['action' => 'InhabitantController@addInh']) }}
                        <div class="form-group">
                           {{ Form::label('name', __("adm_messages.name"), ['class' => 'control-label']) }}
                           {{ Form::text('name', '', ['class' => 'form-control', 'id' => 'name'])}} 
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    
                       <div class="form-group">
                           {{ Form::label('surname', __("adm_messages.surname"), ['class' => 'control-label']) }}
                           {{ Form::text('surname', '', ['class' => 'form-control', 'id' => 'surname'])}} 
                            @if ($errors->has('surname'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('surname') }}
                                </div>
                            @endif
                       </div>
                    
                    
                        <div class="form-group">
                           {{ Form::label('pers', __("adm_messages.pk"), ['class' => 'control-label']) }}
                           {{ Form::text('pers', '', ['class' => 'form-control', 'id' => 'pers'])}} 
                            @if ($errors->has('pers'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('pers') }}
                                </div>
                            @endif
                       </div>
                     
                        {{ Form::submit(__("adm_messages.add"), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

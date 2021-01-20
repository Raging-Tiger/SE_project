@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{__("adm_messages.app_change") }}</h4>
                <div class="card-body">
                    {{ Form::open(['action' => 'ApartmentController@saveApartmentView']) }}
                        <div class="form-group">
                           {{ Form::label('area', __("adm_messages.area"), ['class' => 'control-label']) }}
                           {{ Form::text('area', $apartment->area_m2, ['class' => 'form-control', 'id' => 'area'])}} 
                            @if ($errors->has('area'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                        </div>
                    
                       <div class="form-group">
                           {{ Form::label('number', __("adm_messages.app_no"), ['class' => 'control-label']) }}
                           {{ Form::text('number', $apartment->number, ['class' => 'form-control', 'id' => 'number'])}} 
                            @if ($errors->has('number'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('number') }}
                                </div>
                            @endif
                       </div>
                    
                    
                        <div class="form-group">
                           {{ Form::label('floor', __("adm_messages.floor"), ['class' => 'control-label']) }}
                           {{ Form::text('floor', $apartment->floor, ['class' => 'form-control', 'id' => 'floor'])}} 
                            @if ($errors->has('floor'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('floor') }}
                                </div>
                            @endif
                       </div>
                    
                        <div class="form-group">
                           {{ Form::hidden('id', $apartment->id)}} 
                       </div>
                     
                        {{ Form::submit(__("adm_messages.change_data"), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



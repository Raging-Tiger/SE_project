@extends('layouts.app')
@section('content')
<div class="container">
     <div class="row">
        <div class="col-md-12">
          
            <div class="card-body">
             <h4 class="list-group-item list-group-item-primary">{{ __('inh_messages.ntf_add_new') }}</h4>
                                {{ Form::open(['action' => 'NotificationController@addNew']) }}  
                 <div class="form-group">
                           {{ Form::label('header', __('inh_messages.ntf_header'), ['class' => 'control-label']) }}
                           {{ Form::text('header', '', ['class' => 'form-control'])}}
                            @if ($errors->has('header'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('header') }}
                                </div>
                            @endif
                </div>
                <div class="form-group">
                           {{ Form::label('message', __('inh_messages.ntf_body'), ['class' => 'control-label']) }}
                           {{ Form::text('message', '', ['class' => 'form-control'])}}
                            @if ($errors->has('message'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                </div>
                <div class="form-group">
                           {{ Form::label('status', __('inh_messages.ntf_visibility'), ['class' => 'control-label']) }}
                           {{ Form::select('status', $status, ['class' => 'form-control', 'placeholder' => 'Select visibility type'])}}
                            @if ($errors->has('status'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                </div>
                 <div class="form-group">
                           {{ Form::label('lang', __('inh_messages.lang'), ['class' => 'control-label']) }}
                           {{ Form::select('lang', ['2' => 'ru', '1' => 'en'], ['class' => 'form-control', 'placeholder' => 'Select visibility type'])}}
                            @if ($errors->has('lang'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('lang') }}
                                </div>
                            @endif
                </div>
                                {{ Form::submit(__('inh_messages.ntf_create_new'), ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
                
         </div>
        </div>
     </div>
</div>
@endsection

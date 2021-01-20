@extends('layouts.app')
@section('content')
<div class="container">
     <div class="row">
        <div class="col-md-12">
            
            <table class="table">
                <tr><th>{{ __('inh_messages.ntf_header') }}:</th><td>{{$notification->header }}</td></tr>
                <tr><th>{{ __('inh_messages.ntf_body') }}:</th><td>{{$notification->message }}</td></tr>
                <tr><th>{{ __('inh_messages.ntf_visibility') }}:</th><td>{{ucwords($notification->notificationType->name) }}</td></tr>
                <tr><th>{{ __('inh_messages.ntf_author') }}:</th><td>{{$notification->user->name }}</td></tr>
                <tr><th>{{ __('inh_messages.ntf_date') }}:</th><td>{{$notification->created_at }}</td></tr>
            </table>
            
            
            <div class="card-body">
                                {{ Form::open(['action' => 'NotificationController@save']) }}  
                 <div class="form-group">
                           {{ Form::label('header', __('inh_messages.ntf_header'), ['class' => 'control-label']) }}
                           {{ Form::text('header', $notification->header, ['class' => 'form-control'])}}
                            @if ($errors->has('header'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('header') }}
                                </div>
                            @endif
                </div>
                <div class="form-group">
                           {{ Form::label('message', __('inh_messages.ntf_body'), ['class' => 'control-label']) }}
                           {{ Form::text('message', $notification->message, ['class' => 'form-control'])}}
                            @if ($errors->has('message'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                </div>
                <div class="form-group">
                           {{ Form::label('status', __('inh_messages.ntf_visibility'), ['class' => 'control-label']) }}
                           {{ Form::select('status', $status , $notification->notificationType->id, ['class' => 'form-control'])}}
                            @if ($errors->has('status'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                </div>
                                {{ Form::hidden('notid', $notification->id) }}
                                {{ Form::submit(__('inh_messages.ntf_apply'), ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                
         </div>
        </div>
     </div>
</div>
@endsection


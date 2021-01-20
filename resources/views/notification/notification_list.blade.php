@extends('layouts.app')
@section('content')
<div class="container">
     <div class="row">
        <div class="col-md-12">
            <div>
                {{ Form::open(['action' => 'NotificationController@addNewView']) }}  
                 {{ Form::submit(__('inh_messages.ntf_create'), ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
                <br>
            </div>
                @foreach($notifications as $notification)
                    <div class="card">
                            <h4 class="list-group-item list-group-item-primary">{{$notification->header}}</h4>
                            <div class="card-body">
                                <h3>{{ __('inh_messages.ntf_author') }}: {{$notification->user->name}}; {{ __('inh_messages.ntf_date') }}: {{$notification->created_at }}; {{ __('inh_messages.ntf_type') }}: {{$notification->notificationType->name }}</h3>
                                <div class="float-right">
                                {{ Form::open(['action' => 'NotificationController@delete']) }}  
                                {{ Form::hidden('notid', $notification->id) }}
                                {{ Form::submit(__('inh_messages.ntf_delete'), ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
                                </div>
                                
                                <div class="float-right">
                                {{ Form::open(['action' => ['NotificationController@edit', $notification->id]]) }}  
                                {{ Form::hidden('notid', $notification->id) }}
                                {{ Form::submit(__('inh_messages.ntf_edit'), ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
                                </div>
                                
                                <div>
                                <p> {{$notification->message}} </p>
                                </div>
                            </div>
                    </div>
                    <br>
                    

                @endforeach
                
                {!!$notifications->links()!!}
        </div>
     </div>
</div>
@endsection

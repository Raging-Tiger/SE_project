@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{__("adm_messages.role_change") }}</h4>
                <div class="card-body">
                    
        
            {{__("adm_messages.user_name") }}: {{$user -> name }}
            <br>
            {{__("adm_messages.user_email") }}: {{$user -> email }}
     
        
        
        
        <br>
        <br>
        
       {{ Form::open(['action' => ['UserController@setRole', $user->id]]) }}
                {{ Form::hidden('userid', $user->id, ['class' => 'userid', 'id' => 'userid'])}}
                {{ Form::select('status', $role , null, ['placeholder' => __("adm_messages.role_select")])}}
                {{ Form::submit(__("adm_messages.role_add"), ['class' => 'btn btn-primary'])}}
       {{ Form::close() }}
                            @if ($errors->has('status'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



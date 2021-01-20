@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{__("adm_messages.user_connect") }}</h4>
                <div class="card-body">
            <div>               
            {{__("adm_messages.user_name") }}: {{$user -> name }} <br>
            {{__("adm_messages.user_email") }}: {{$user -> email }}
            </div>
        
        <br>
        <br>
        <table class="table">
            @foreach($inhs as $inh)
            <tr>
            <td>{{ $inh->id }} </td>
            <td>{{ $inh->name }} </td>
            <td>{{ $inh->surname }} </td>
            <td>{{ $inh->personal_code }} </td>
            
            
            <td>{{ Form::open(['action' => ['UserController@setUser']]) }}
                {{ Form::hidden('userid', $user->id, ['class' => 'userid', 'id' => 'userid'])}}
                {{ Form::hidden('inhid', $inh->id, ['class' => 'inhid', 'id' => 'inhid'])}}
           {{ Form::submit(__("adm_messages.user_connect"), ['class' => 'btn btn-primary'])}}
       {{ Form::close() }} </td>
            </tr>
            @endforeach
        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



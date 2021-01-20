@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table">
        <tr>
        <th>{{__("adm_messages.user_name") }}</th>
        <th>{{__("adm_messages.role") }}</th>
        <th>{{__("adm_messages.fname") }}</th>
        <th>{{__("adm_messages.role_change") }}</th>
   
        </tr>
        @foreach ( $users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role->name }}</td>
            <td> 
               
                @isset($user->inhabitant) 

                    {{ $user->inhabitant->name }}
                    {{ $user->inhabitant->surname }}
                    
                @else
              {{ __("adm_messages.user_not_connected") }}
              {{ Form::open(['action' => ['UserController@assignInh'], 'method' => 'get']) }}
                {{ Form::hidden('userid', $user->id, ['class' => 'userid'])}}
                {{ Form::submit(__("adm_messages.user_connect"), ['class' => 'btn btn-primary'])}}
            {{ Form::close() }}
                @endisset
             </td>
             <td>
            {{ Form::open(['action' => ['UserController@adminUsersRoleShow', $user->id], 'method' => 'get']) }}
                {{ Form::hidden('userid', $user->id, ['class' => 'userid'])}}
                {{ Form::submit(__("adm_messages.role_change"), ['class' => 'btn btn-primary'])}}
            {{ Form::close() }}
                 
             </td>
             
        </tr>
        @endforeach  
    </table>
</div>
@endsection



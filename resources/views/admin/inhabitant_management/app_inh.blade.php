@extends('layouts.app')
@section('content')
<div class="container">
   <div> 
    {{ __('adm_messages.name') }}: {{$inh->name }}
    <br>
    {{ __('adm_messages.surname') }}: {{$inh->surname}}
    <br>
    {{ __('adm_messages.pk') }}: {{$inh->personal_code}}
    <br>
   </div>
    
    <table class="table">
        <tr>
            <th>{{ __('adm_messages.app_no') }}</th>
            <th>{{ __('adm_messages.del') }}</th>
        </tr>
        
    @foreach($inh->appinh as $j)
    <tr>
    <td>{{$j->apartment->number}}</td>
  
    <td>
        {{ Form::open(['action' => ['InhabitantController@destroyInhApp', $inh->id]]) }}
            {{Form::hidden('_method','DELETE')}}
            {{ Form::hidden('iaid', $j->id, ['class' => 'iaid'])}}
            {{ Form::submit( __('adm_messages.del'), ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
        </td>
    @endforeach
            
        </tr>
    </table>

     {{ Form::open(['action' => ['InhabitantController@addInhApp', $inh->id]]) }}
                {{ Form::hidden('inhid', $inhid, ['class' => 'inhid', 'id' => 'inhid'])}}
                
                <div class="form-group">
                           {{ Form::label('appno', __('adm_messages.app'), ['class' => 'control-label']) }}
                           {{ Form::select('appno', $apps , null, ['placeholder' => 'Select an appartment'])}}
                            @if ($errors->has('appno'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('appno') }}
                                </div>
                            @endif
                </div>
                

                {{ Form::submit( __('adm_messages.connect'), ['class' => 'btn btn-primary'])}}
       {{ Form::close() }}
</div>
@endsection



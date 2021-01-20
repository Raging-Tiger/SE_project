@extends('layouts.app')
@section('content')
<div class="container">
    @if ($errors->has('meter'))
        <div class="alert alert-danger">
            {{ $errors->first('meter') }}
        </div>
    @endif  

    <table class="table">
        <tr>
        <th>{{ __("adm_messages.app_no") }}</th>
        <th>Meter ID</th>
        <th>Type</th>
        <th>Data</th>
        <th>Date of submission</th>
        <th>Verified till</th>
        <th>Edit</th>
        <th>Verification upload</th>
        </tr>

        @foreach ($meters as $meter)

        <tr>
            <td>{{ $meter->apartment->number }} </td>
            <td>{{ $meter->id }} </td>
            <td>{{ $meter->meterType->name }} </td>
            <td>{{ $meter->amount }} </td>
            <td>{{ $meter->created_at }} </td>
            <td>{{ $meter->verified_till }} </td>
            <td>
                {{ Form::open(['action' => ['MeterController@editMeter', $meter->id]]) }}
                    {{ Form::submit( __('adm_messages.edit'), ['class' => 'btn btn-primary'])}}
                {{ Form::close() }}
                
            </td>
            <td>
                @if($meter->verified_till <= \Carbon\Carbon::now())
                {{   Form::open(array('url' => '/uploadfile','files'=>'true')) }}
                    {{ Form::file('meter') }}
                    {{ Form::hidden('meterid', $meter->id)}}
                    {{ Form::submit(__('inh_messages.upload_file')) }}
                 {{ Form::close() }}</td>
                @endif
            
        </tr>

        @endforeach  
    </table>
</div>
@endsection






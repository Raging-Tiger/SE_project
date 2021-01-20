@extends('layouts.app')
@section('content')
<div class="container">
    
   <div>
    <table class="table table-responsive-sm table-bordered">
        <tr><td> Meter ID </td><td>{{$meter->id}}</td></tr>
        <tr><td> Apartment no.</td><td>{{$meter->apartment->number}}</td></tr>
        <tr><td> Data</td><td>{{$meter->amount}} </td></tr>
        <tr><td> Date of submission </td><td>{{$meter->created_at}}</td></tr>
        <tr><td> Verified till </td><td>{{$meter->verified_till}}</td></tr>
    </table>
   </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">Change meter's data</h4>
                <div class="card-body">
                {{ Form::open(['action' => 'MeterController@setMeterEdit']) }}

                    
                       <div class="form-group">
                           {{ Form::label('amount', 'Meter data', ['class' => 'control-label']) }}
                           {{ Form::text('amount', $meter->amount , ['class' => 'form-control', 'id' => 'amount'])}} 
                            @if ($errors->has('amount'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                       </div>
                
                      <div class="form-group">
                            {{ Form::label('date', __('adm_messages.month'), ['class' => 'control-label']) }}
                            {{ Form::date('date', \Carbon\Carbon::now()) }}
                             @if ($errors->has('date'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                       </div>
                        {{ Form::hidden('meterid', $meter->id)}}
                        {{ Form::submit(__('adm_messages.change_data'), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
    
               </div>
            </div>
        </div>
    </div>
</div>

@endsection 



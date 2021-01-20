@extends('layouts.app')
@section('content')
<div class="container">
    
   <div>
    <table class="table table-responsive-sm table-bordered">
        <tr><td> {{ __('adm_messages.bill_id') }}</td><td>{{$bill->id}}</td></tr>
        <tr><td> {{ __('adm_messages.app_no') }}</td><td>{{$bill->apartment_id}}</td></tr>
        <tr><td> Cost per m2</td><td> {{$bill->cost_per_m2 }}</td></tr>
        <tr><td> Management cost</td><td>{{$bill->management_cost}}</td></tr>
        <tr><td> Utility cost</td><td>{{$bill->total_meters_cost}}</td></tr>
        <tr><td> {{ __('adm_messages.bill_status') }}</td><td>{{$bill->billStatus->name}}</td></tr>
    </table>
   </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ __('adm_messages.bill_change') }}</h4>
                <div class="card-body">
                {{ Form::open(['action' => 'BillController@setBillEdit']) }}
                    
                    <div class="form-group">
                            {{ Form::label('admsummeter', __('adm_messages.ac_per_m2'), ['class' => 'control-label']) }}
                            {{ Form::text('admsummeter', $bill->management_cost, ['class' => 'form-control', 'id' => 'admsummeter'])}} 
                             @if ($errors->has('admsummeter'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('admsummeter') }}
                                </div>
                            @endif
                    </div>
                     
                     <div class="form-group">
                            {{ Form::label('admsum', __('Cost per m2'), ['class' => 'control-label']) }}
                            {{ Form::text('admsum', $bill->cost_per_m2, ['class' => 'form-control', 'id' => 'admsum'])}} 
                             @if ($errors->has('admsum'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('admsum') }}
                                </div>
                            @endif
                    </div>
                     
                     <div class="form-group">
                            {{ Form::label('total', __('Total utility cost'), ['class' => 'control-label']) }}
                            {{ Form::text('total', $bill->total_meters_cost, ['class' => 'form-control', 'id' => 'total'])}} 
                             @if ($errors->has('total'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('total') }}
                                </div>
                            @endif
                    </div>
                     
                   
                    <div class="form-group">
                           {{ Form::label('status', __('adm_messages.bill_status'), ['class' => 'control-label']) }}
                             {{ Form::select('status', $status , $bill->billStatus->id)}}
                            @if ($errors->has('status'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                    </div>
                         {{ Form::hidden('billid', $bill->id)}}
                        {{ Form::submit(__('adm_messages.change_data'), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
    
               </div>
            </div>
        </div>
    </div>
</div>

@endsection

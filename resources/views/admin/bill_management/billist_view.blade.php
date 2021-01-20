@extends('layouts.app')
@section('content')
<div class="container">
    <div>
        {{ Form::open(['url' => '/admin/bill/add', 'method' => 'get']) }}
                {{ Form::submit( __('Create new bill'), ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
        <br>
    </div>
    <table class="table">
        <tr>
           <th>{{ __('adm_messages.bill_id') }}</th>
            <th>{{ __('adm_messages.app_no') }}</th>
            <th>Cost per m2</th>
            <th>Management cost</th>
            <th>Utility cost</th>
            <th>{{ __('adm_messages.status') }}</th>
            <th>{{ __('adm_messages.edit') }}</th>
            <th>{{ __('adm_messages.see_payment') }}</th>
        </tr>
        @foreach($bills as $bill)
        <tr>
            <td>{{ $bill->id }}</td>
            <td>{{ $bill->apartment->number }}</td>
            <td>{{ $bill->cost_per_m2 }}</td>
            <td>{{ $bill->management_cost }}</td>
            <td>{{ $bill->total_meters_cost }}</td>
            <td>{{ $bill->billStatus->name }}</td>
            <td>    
            {{ Form::open(['action' => ['BillController@editBill', $bill->id]]) }}
               {{ Form::submit(__('adm_messages.edit'), ['class' => 'btn btn-primary'])}}
            {{ Form::close() }}
            </td>
            <td>@if($bill->billStatus->id == 4) 
                
        {{ Form::open(['action' => ['BillController@downloadBill']]) }}
                {{ Form::hidden('billid',  $bill->id)}}
                {{ Form::submit(__('adm_messages.download'), ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
            
            @endif</td>
        </tr>
        @endforeach
        
        
    </table>
  
</div>
@endsection


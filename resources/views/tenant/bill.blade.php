@extends('layouts.app')
@section('content')
<div class="container">
    @if ($errors->has('bill'))
        <div class="alert alert-danger">
            {{ $errors->first('bill') }}
        </div>
    @endif  
    <table class="table">
        <tr>
        <th>{{ __('adm_messages.bill_id') }}</th>
        <th>{{ __('adm_messages.app_no') }}</th>
        <th>Cost per m2</th>
        <th>Management cost</th>
        <th>Utility cost</th>
        <th>{{ __('adm_messages.sum') }}</th>
        <th>{{ __('adm_messages.status') }}</th>
        <th>Upload payment</th>
        <th>{{ __('inh_messages.bill_pdf') }}</th>
        </tr>
    @foreach($js as $j)

        @foreach($j as $bill)
            @if($bill->billStatus->id == 2)
            <tr class="table-success">
            @elseif($bill->billStatus->id == 4 || $bill->billStatus->id == 1)
            <tr class="table-warning">
            @else
            <tr class="table-danger">
            @endif
                <td>{{$bill->id}}</td>
                <td>{{ $bill->apartment->number }}</td>
                <td>{{ $bill->cost_per_m2 }}</td>
                <td>{{ $bill->management_cost }}</td>
                <td>{{ $bill->total_meters_cost }}</td>
                <td>{{ $bill->total_meters_cost + $bill->cost_per_m2 + $bill->management_cost }}</td>
                <td>{{ $bill->billStatus->name }}</td>
                <td>
                @if ($bill->billStatus->id != 2)
                 {{   Form::open(array('url' => '/uploadbill','files'=>'true')) }}
                    {{ Form::file('bill') }}
                    {{ Form::hidden('billid', $bill->id)}}
                    {{ Form::submit(__('inh_messages.upload_file')) }}
                 {{ Form::close() }}
                @endif
                </td>
                <td>
                   {{ Form::open(['action' => ['BillController@download']]) }}
                                {{ Form::hidden('billid', $bill->id)}}
                                {{ Form::submit(__('inh_messages.download'), ['class' => 'btn btn-primary'])}}
                   {{ Form::close() }} 
                </td>
            </tr>
        @endforeach
    @endforeach
    </table>
</div>

@endsection



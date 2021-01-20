@extends('layouts.app')
@section('content')
<div class="container">
    <div>
        {{ Form::open(['url' => '/admin/fines/add', 'method' => 'get']) }}
                {{ Form::submit( __('adm_messages.fine_add'), ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
        <br>
    </div>
    
    <table class="table">
        <tr>
            <th>{{ __('adm_messages.fine_id') }}</th>
            <th>{{ __('adm_messages.type') }}</th>
            <th>{{ __('adm_messages.fname') }}</th>
            <th>{{ __('adm_messages.sum') }} </th>
            <th>{{ __('adm_messages.status') }} </th>
            <th>{{ __('adm_messages.edit') }}</th>
            <th>{{ __('adm_messages.del') }} </th>
            <th>{{ __('adm_messages.change_status') }} </th>
        </tr>
        @foreach($fines as $fine)
        <tr>
            <td>{{$fine->id }}</td>
            <td>{{$fine->fineReason->name }}</td>
            <td>{{$fine->inhabitant->name }} {{$fine->inhabitant->surname }} {{$fine->inhabitant->personal_code }}</td>
            <td>@isset($fine->sum){{$fine->sum }} EUR
                @else
                @endisset
            </td>
            <td>{{$fine->fineStatus->name }}</td>
            <td> {{ Form::open(['action' => ['FineController@editFine', $fine->id]]) }}
                {{ Form::submit( __('adm_messages.edit'), ['class' => 'btn btn-primary'])}}
            {{ Form::close() }}</td>

           <td> {{ Form::open(['action' => ['FineController@deleteFine']]) }}
                {{ Form::hidden('fineid', $fine->id)}}
                {{ Form::submit( __('adm_messages.del'), ['class' => 'btn btn-primary'])}}
                {{ Form::close() }}</td>
           <td>
                {{ Form::open(['action' => ['FineController@editFineStatus', $fine->id]]) }}
                    {{ Form::submit( __('adm_messages.change'), ['class' => 'btn btn-primary'])}}
                {{ Form::close() }}
           </td>
        </tr>
        
        @endforeach
        
        
    </table>
  {!! $fines->links() !!}
</div>
@endsection 
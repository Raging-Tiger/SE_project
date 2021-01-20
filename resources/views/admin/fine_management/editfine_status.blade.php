@extends('layouts.app')
@section('content')
<div class="container">
    
   <div>
    <table class="table table-responsive-sm table-bordered">
        <tr><td> {{ __('adm_messages.fine_id') }}</td><td>{{$fine->id}}</td></tr>
        <tr><td> {{ __('adm_messages.fname') }}</td><td>{{$fine->inhabitant->name}} {{$fine->inhabitant->surname}}</td></tr>
        <tr><td> {{ __('adm_messages.reason') }}</td><td>{{$fine->fineReason->name}} </td></tr>
        <tr><td> {{ __('adm_messages.sum') }} </td><td>{{$fine->sum}}</td></tr>
    </table>
   </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ __('adm_messages.fine_change') }}</h4>
                <div class="card-body">
                {{ Form::open(['action' => 'FineController@setFineStatus']) }}
                        <div class="form-group">
                           {{ Form::label('status', __('adm_messages.status'), ['class' => 'control-label']) }}
                             {{ Form::select('status', $status , $fine->fineReason->id)}}
                            @if ($errors->has('status'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                        </div>
                        {{ Form::hidden('fineid', $fine->id)}}
                        {{ Form::submit(__('adm_messages.change_data'), ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
    
               </div>
            </div>
        </div>
    </div>
</div>

@endsection 


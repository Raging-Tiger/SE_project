@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="list-group-item list-group-item-primary">{{ __('inh_messages.list_fines') }}</h4>
                <div class="card-body">
                    <table class="table">
                        <tr>
                        <th>{{ __('inh_messages.name') }}</th>
                        <th>{{ __('inh_messages.reason') }}</th>
                        <th>{{ __('inh_messages.sum') }}</th>
                       <th>{{ __('inh_messages.status') }}</th>
                        <th>{{ __('inh_messages.invoice') }}</th>
                        
                        </tr>
                      @foreach($fines as $fine)
                      <tr>
                       <td> {{$fine->inhabitant->name }} {{$fine->inhabitant->surname }}</td>
                       <td>{{$fine->fineReason->name }} </td>
                       <td> @isset($fine->sum)   {{$fine->sum }}
                            @else
                            @endisset
                       </td>
                       <td>
                       {{$fine->fineStatus->name }}
                       </td>
                       <td>
                           @isset($fine->sum)
                            {{ Form::open(['action' => ['FineController@download']]) }}
                                {{ Form::hidden('fineid', $fine->id)}}
                                {{ Form::submit(__('inh_messages.download'), ['class' => 'btn btn-primary'])}}
                            {{ Form::close() }}
                            @endisset
                       </td>
                      </tr>
                      @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



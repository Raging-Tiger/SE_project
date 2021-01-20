@extends('layouts.app')

@section('content')
<div class="container">
<div class="float-right">
    
    {{ Form::open(['action' => 'ApartmentController@email'])}}  
        {{ Form::label('mail', __('inh_messages.email'), ['class' => 'control-label']) }}
            {{Form::checkbox('mail', '1', $email)}}
        {{ Form::submit(__('inh_messages.confirm'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>
@isset($ai)
@foreach($ai as $aa)
  <div> {{ __('inh_messages.app_no_full') }}: {{ $aa->apartment->number }} <br>
   {{ __('inh_messages.area') }}: {{ $aa->apartment->area_m2 }} <br>
   {{ __('inh_messages.floor') }}: {{ $aa->apartment->floor }} <br> <br>
   
  </div>
@endforeach

@else
<p>{{ __('inh_messages.denial') }}</p>
@endisset
</div>
@endsection
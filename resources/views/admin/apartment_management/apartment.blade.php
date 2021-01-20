@extends('layouts.app')
@section('content')
<div class="container">


    <table class="table">
        <tr>
        <th>{{ __("adm_messages.app_no") }}</th>
        <th>{{ __("adm_messages.area") }}</th>
        <th>{{ __("adm_messages.floor") }}</th>
        <th></th>
        </tr>
        @foreach ($apartments as $apartment)
        <tr>
            <td>{{ $apartment->number }} </td>
            <td>{{ $apartment->area_m2 }}</td>
            <td>{{ $apartment->floor }}</td>
            <td>
                {{ Form::open(['action' => ['ApartmentController@editApartmentView', $apartment->id], 'method'=>'post']) }}
                    {{ Form::submit( __("adm_messages.edit"), ['class' => 'btn btn-primary'])}}
                {{ Form::close() }}
                
            </td>
        </tr>

        @endforeach  
    </table>
</div>
@endsection




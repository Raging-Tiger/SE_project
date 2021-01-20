@extends('layouts.app')
@section('content')
<div class="container">


    <table class="table">
        <tr>
        <th>{{ __("adm_messages.fname") }}</th>
        <th>{{ __("adm_messages.pk") }}</th>
        <th>{{ __("adm_messages.username") }}</th>
        <th>{{ __("adm_messages.app_no") }}</th>
        <th>{{ __("adm_messages.ada") }}</th>
        </tr>
        @foreach ($inhs as $inh)
        <tr>
            <td>{{ $inh->name }} {{ $inh->surname }}</td>
            <td>{{ $inh->personal_code }}</td>
            <td> 
               
                @isset($inh->user_id) 

                    {{ $inh->user->name }}
                    
                @else
                {{ __("adm_messages.inh_no_acc") }}
                @endisset
                
             </td>
             <td>
                    @php $check = false @endphp 
                     @foreach ($app_inh as $i) 
                    
                        @if($i->inhabitant_id == $inh->id)
                            {{ $i->apartment->number }};
                             @php $check = true @endphp 
                        @endif
                        
                    

                    @endforeach
                    
                     @if($check == false )
                       No appartment
                    @endif
                 
             </td>
             <td>
        {{ Form::open(['action' => ['InhabitantController@connectWithInh', $inh->id], 'method'=>'post']) }}
                {{ Form::submit( __("adm_messages.ada"), ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
             </td>
        </tr>

        @endforeach  
    </table>
</div>
@endsection


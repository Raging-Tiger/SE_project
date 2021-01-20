@extends('layouts.app')
@section('content')

<script type="application/javascript">
$(document).ready(function () {
    $("#search").keyup(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.post("/admin/fines/add", { search: $('#search').val(), _token: CSRF_TOKEN }, function(data) {
            $('.persona').html('');
            $.each(data, function(i, persona) {
                var c = '<div class="list-group-item">\n\
                              <h4>'+'{{ __("adm_messages.pk") }}: '+persona.personal_code+'; {{ __("adm_messages.name") }}: '+persona.name+' '+persona.surname +'.</h4>\n\
                              '+'<a href="/admin/fines/add/'+persona.id+'">'+'{{ __("adm_messages.fine_add") }}'+'</a></div>';
                 $('.persona').append(c);
            });
        });
    })
});
</script>
<div class="container">
{{ Form::open() }}    
 {{ Form::text('search', '', ['class' => 'form-control', 'id' => 'search'])}} 
{{ Form::close() }}

<br>

<div class="persona"></div>

</div>
@endsection 


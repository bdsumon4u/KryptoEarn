@component('mail::message')
# Message:

{!! nl2br($data['message']) !!}

From,<br>
{{ $data['name'] }},<br>
{{ $data['email'] }}
@endcomponent

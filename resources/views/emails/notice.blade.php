@component('mail::message')
# {{ $data['title'] }}

Dear User,<br>
{!! nl2br($data['content']) !!}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

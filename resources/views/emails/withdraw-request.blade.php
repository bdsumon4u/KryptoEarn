@component('mail::message')
# WithdrawRequest

A new withdraw request received for {{ $withdraw->amount }} {{ $withdraw->currency }} via {{ $withdraw->gatewayName }}.

@component('mail::button', ['url' => action([\App\Http\Controllers\Admin\WithdrawController::class, 'edit'], $withdraw)])
Detail
@endcomponent

From,<br>
{{ config('app.name') }}
@endcomponent

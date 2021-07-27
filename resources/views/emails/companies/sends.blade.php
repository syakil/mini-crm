@component('mail::message')
# Welcome TO PT Agung Trisula Mandiri

your company has been registered.

@component('mail::button', ['url' => ''])
Cool !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

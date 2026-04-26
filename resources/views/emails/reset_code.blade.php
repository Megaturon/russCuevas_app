<x-mail::message>
# Reset Your Password

Hello,

You are receiving this email because we received a password reset request for your account.

Your verification code is:

<x-mail::panel>
# {{ $code }}
</x-mail::panel>

This code will expire in 10 minutes. If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

@component('mail::message')
# Welcome to our team!

You are receiving this email because an account was created for you.

Please click the button bellow to activate your account.

@component('mail::button', ['url' => route('password.request') ])
    {{ __('Change Your Password') }}
@endcomponent


Thanks,<br>
Jewelry Warehouse Management System Team
@endcomponent


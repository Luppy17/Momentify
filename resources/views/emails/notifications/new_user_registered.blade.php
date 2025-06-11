<x-mail::message>
# New User Registration

A new user has registered on Momentify.

**Name:** {{ $newUser->name }}<br>
**Email:** {{ $newUser->email }}<br>
**Role:** {{ $roleName }}<br>

@if ($managementLink)
Please review their registration and manage their role if necessary:
<x-mail::button :url="$managementLink">
Manage User
</x-mail::button>
@else
You can manage users in the admin panel.
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

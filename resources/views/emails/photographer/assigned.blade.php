<x-mail::message>
# New Event Assignment

Hi {{ $photographerName }},

You have been assigned to a new event:

**Event Name:** {{ $eventName }}<br>
**Date:** {{ $eventDate }}<br>
**Time:** {{ $eventTime }}<br>
**Place:** {{ $eventPlace }}

You can view the event details here:
<x-mail::button :url="$eventUrl">
View Event
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

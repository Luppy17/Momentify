<x-mail::message>
# New Event Assignment

Hi {{ $photographerName }},

You have been assigned to a new event:

**Event Name:** {{ $eventName }}
**Date:** {{ $eventDate }}
**Time:** {{ $eventTime }}
**Place:** {{ $eventPlace }}

You can view the event details here:
<x-mail::button :url="$eventUrl">
View Event
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

@component('mail::message')
# Ticket Created

Hello {{ $ticket->user->name }},

Your ticket **{{ $ticket->title }}** has been created successfully.  
We’ll get back to you soon.

**Status:** {{ ucfirst($ticket->status) }}  
**Priority:** {{ ucfirst($ticket->priority) }}

@component('mail::button', ['url' => route('tickets.show', $ticket)])
View Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

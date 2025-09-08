@component('mail::message')
# Ticket Status Updated

Hello {{ $ticket->user->name }},

Your ticket **{{ $ticket->title }}** status has been updated.

**New Status:** {{ ucfirst($ticket->status) }}  
**Priority:** {{ ucfirst($ticket->priority) }}

@component('mail::button', ['url' => route('tickets.show', $ticket)])
View Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

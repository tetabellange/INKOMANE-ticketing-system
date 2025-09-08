@component('mail::message')
# New Comment on Your Ticket

Hello {{ $ticket->user->name }},

A new comment was added to your ticket **{{ $ticket->title }}**.

**Comment:**  
"{{ $comment->comment }}"

@component('mail::button', ['url' => route('tickets.show', $ticket)])
View Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

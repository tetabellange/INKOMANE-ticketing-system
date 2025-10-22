<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller; // ✅ Import base Controller
use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use App\Mail\TicketStatusUpdated;
use App\Mail\TicketCommentAdded;
use Illuminate\Support\Facades\Mail;

class AgentTicketController extends Controller
{
    /**
     * Display a list of tickets assigned to the logged-in agent.
     */
    public function index()
    {
        $tickets = Ticket::where('agent_id', auth()->id())
                         ->latest()
                         ->paginate(10);

        return view('agent.tickets.index', compact('tickets'));
    }

    /**
     * Show a single ticket with comments.
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        $ticket->load('comments.user');

        return view('agent.tickets.show', compact('ticket'));
    }

    /**
     * Update ticket status.
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $data = $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed'
        ]);

        $ticket->update(['status' => $data['status']]);

        // Notify customer via email
        Mail::to($ticket->user->email)->queue(new TicketStatusUpdated($ticket));

        return back()->with('ok', 'Ticket status updated.');
    }

    /**
     * Add an internal note to a ticket.
     */
    public function addInternalNote(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $data = $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        $comment = TicketComment::create([
            'ticket_id'  => $ticket->id,
            'user_id'    => auth()->id(),
            'comment'    => $data['comment'],
            'is_internal'=> true,
        ]);

        // Notify customer about the internal note (optional)
        Mail::to($ticket->user->email)->queue(new TicketCommentAdded($ticket, $comment));

        return back()->with('ok', 'Internal note added.');
    }
}

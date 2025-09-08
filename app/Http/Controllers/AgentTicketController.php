<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use App\Mail\TicketStatusUpdated;
use App\Mail\TicketCommentAdded;
use Illuminate\Support\Facades\Mail;

class AgentTicketController extends Controller
{
    public function index() {
        // Show tickets assigned to the logged-in agent
        $tickets = Ticket::where('agent_id', auth()->id())->latest()->paginate(10);
        return view('agent.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket) {
        $this->authorize('view', $ticket);
        $ticket->load('comments.user');
        return view('agent.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed'
        ]);

        $ticket->update(['status' => $data['status']]);

        // -------- EMAILS ----------
        Mail::to($ticket->user->email)->queue(new TicketStatusUpdated($ticket));
        // --------------------------

        return back()->with('ok', 'Ticket status updated.');
    }

    public function addInternalNote(Request $request, Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'comment' => $data['comment'],
            'is_internal' => true,
        ]);

        // -------- EMAILS ----------
        // Notify customer about update
        Mail::to($ticket->user->email)->queue(new TicketCommentAdded($ticket, $comment));
        // --------------------------

        return back()->with('ok', 'Internal note added.');
    }
}

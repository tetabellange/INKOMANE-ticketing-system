<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Show list of tickets assigned to the agent
    public function index()
    {
        $tickets = Ticket::where('assigned_to', auth()->id())->get();
        return view('agent.tickets.index', compact('tickets'));
    }

    // Show details of a specific ticket
    public function show(Ticket $ticket)
    {
        // ensure only assigned agent can view
        if ($ticket->assigned_to !== auth()->id()) {
            abort(403);
        }
        return view('agent.tickets.show', compact('ticket'));
    }
}

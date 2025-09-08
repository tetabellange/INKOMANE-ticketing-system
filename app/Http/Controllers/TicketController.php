<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketAttachment;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use App\Mail\TicketCreated;
use App\Mail\TicketCommentAdded;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index(Request $request) {
        $tickets = Ticket::where('user_id', $request->user()->id)->latest()->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    public function create() {
        $categories = TicketCategory::where('is_active', true)->get();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:ticket_categories,id',
            'priority' => 'required|in:low,normal,high,urgent',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,gif,pdf|max:5120'
        ]);

        // Create ticket
        $ticket = Ticket::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority'],
            'category_id' => $data['category_id'] ?? null,
            'user_id' => $request->user()->id,
            'status' => 'new',
        ]);

        // Save attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                TicketAttachment::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $request->user()->id,
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        // -------- EMAILS ----------
        Mail::to(auth()->user()->email)->queue(new TicketCreated($ticket));

        $agent = $ticket->agent; // requires agent() relation in Ticket model
        if ($agent) {
            Mail::to($agent->email)->queue(new TicketCreated($ticket));
        }
        // --------------------------

        return redirect()->route('tickets.show', $ticket)->with('ok', 'Ticket created!');
    }

    public function show(Ticket $ticket) {
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }
        $comments = $ticket->comments()->where('is_internal', false)->latest()->get();
        return view('tickets.show', compact('ticket','comments'));
    }

    public function comment(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'comment' => 'required|string|max:2000',
        ]);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'comment' => $data['comment'],
            'is_internal' => false,
        ]);

        // -------- EMAILS ----------
        // Notify agent if assigned
        if ($ticket->agent_id && $ticket->agent_id != auth()->id()) {
            Mail::to($ticket->agent->email)->queue(new TicketCommentAdded($ticket, $comment));
        }
        // --------------------------

        return back()->with('ok', 'Comment added successfully!');
    }
}

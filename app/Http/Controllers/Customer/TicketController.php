<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Show tickets created by the customer
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        return view('customer.tickets.index', compact('tickets'));
    }

    // Create a new ticket form
    public function create()
    {
        return view('customer.tickets.create');
    }

    // Store ticket
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id'     => auth()->id(),
            'subject'     => $request->subject,
            'description' => $request->description,
            'status'      => 'open',
        ]);

        return redirect()->route('customer.tickets.index')->with('success', 'Ticket created successfully.');
    }
}

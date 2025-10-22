@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-2xl p-8 mt-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📨 My Tickets</h1>
        <div class="flex gap-3">
            <a href="{{ route('customer.dashboard') }}" 
               class="bg-gray-700 text-white px-5 py-2 rounded-xl hover:bg-gray-800 transition duration-200">
                🏠 Dashboard
            </a>
            <a href="{{ route('customer.tickets.create') }}" 
               class="bg-black text-white px-5 py-2 rounded-xl hover:bg-gray-800 transition duration-200">
                + New Ticket
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($tickets->isEmpty())
        <p class="text-gray-500 text-center py-10">You haven’t created any tickets yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border text-left">#</th>
                        <th class="p-3 border text-left">Subject</th>
                        <th class="p-3 border text-left">Status</th>
                        <th class="p-3 border text-left">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 border font-medium">{{ $loop->iteration }}</td>
                            <td class="p-3 border font-medium text-gray-800">
                                <a href="{{ route('customer.tickets.show', $ticket) }}" class="text-blue-600 hover:underline">
                                    {{ $ticket->subject }}
                                </a>
                            </td>
                            <td class="p-3 border capitalize">
                                <span class="px-3 py-1 rounded-full text-sm
                                    @if($ticket->status === 'open') bg-green-100 text-green-700
                                    @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-700
                                    @elseif($ticket->status === 'closed') bg-gray-100 text-gray-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ str_replace('_', ' ', $ticket->status) }}
                                </span>
                            </td>
                            <td class="p-3 border text-gray-600">{{ $ticket->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6 text-center">
        <a href="{{ route('customer.dashboard') }}" 
           class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
            ← Back to Dashboard
        </a>
    </div>
</div>
@endsection

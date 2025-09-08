<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">
        <div class="bg-purple-700 text-white rounded-lg p-6 shadow">
            <h1 class="text-2xl font-bold">Agent Tickets</h1>
            <p class="mt-2">Welcome, {{ auth()->user()->name }}!</p>
        </div>

        <div class="space-y-4">
            @forelse($tickets as $ticket)
                <div class="bg-white shadow rounded-lg p-4 flex justify-between items-center">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $ticket->title }}</h2>
                        <p>Status: <span class="font-medium">{{ ucfirst($ticket->status) }}</span> | Priority: {{ ucfirst($ticket->priority) }}</p>
                        <p>Customer: {{ $ticket->user->name }}</p>
                    </div>
                    <a href="{{ route('agent.tickets.show', $ticket) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">View</a>
                </div>
            @empty
                <p>No tickets assigned yet.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $tickets->links() }}
        </div>
    </div>
</x-app-layout>

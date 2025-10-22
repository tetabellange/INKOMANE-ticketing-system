<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">

        <h1 class="text-3xl font-bold text-blue-800 mb-8">💬 All Customer Tickets</h1>

        @if($tickets->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tickets as $ticket)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="font-semibold text-lg text-gray-800">{{ $ticket->subject }}</h2>
                        <p class="text-gray-600 mt-1">{{ Str::limit($ticket->description, 100) }}</p>
                        <p class="text-gray-500 text-sm mt-2">Created by: {{ $ticket->user->name ?? 'N/A' }}</p>
                        <p class="text-gray-500 text-sm">Status: {{ ucfirst($ticket->status) }}</p>
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="mt-3 inline-block px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            View Ticket
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-700 text-center">No tickets have been created yet.</p>
        @endif

        <div class="mt-10 text-center">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                Back to Dashboard
            </a>
        </div>

    </div>
</x-app-layout>

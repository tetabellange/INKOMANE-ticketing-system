<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold">{{ $ticket->title }}</h1>
            <p class="mt-2">Status: <strong>{{ ucfirst($ticket->status) }}</strong> | Priority: {{ ucfirst($ticket->priority) }}</p>
            <p class="mt-2">Customer: {{ $ticket->user->name }}</p>
            <p class="mt-2">{{ $ticket->description }}</p>
        </div>

        {{-- Update Status --}}
        @can('update', $ticket)
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="font-semibold text-xl mb-2">Update Status</h2>
                <form action="{{ route('agent.tickets.updateStatus', $ticket) }}" method="POST">
                    @csrf
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="new" @if($ticket->status=='new') selected @endif>New</option>
                        <option value="in_progress" @if($ticket->status=='in_progress') selected @endif>In Progress</option>
                        <option value="resolved" @if($ticket->status=='resolved') selected @endif>Resolved</option>
                        <option value="closed" @if($ticket->status=='closed') selected @endif>Closed</option>
                    </select>
                    <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update Status</button>
                </form>
            </div>

            {{-- Add Internal Note --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="font-semibold text-xl mb-2">Add Internal Note</h2>
                <form action="{{ route('agent.tickets.addInternalNote', $ticket) }}" method="POST">
                    @csrf
                    <textarea name="comment" rows="3" class="w-full border rounded px-3 py-2" placeholder="Internal note..."></textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Note</button>
                </form>
            </div>
        @endcan

        {{-- Comments --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-semibold text-xl mb-2">Comments</h2>
            @forelse($comments as $comment)
                <div class="border-b py-2">
                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                    <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }} 
                        @if($comment->is_internal) <span class="text-red-500">(Internal)</span> @endif
                    </p>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

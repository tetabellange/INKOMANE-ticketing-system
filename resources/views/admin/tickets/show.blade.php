<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6 space-y-6">

        <h1 class="text-3xl font-bold text-blue-800 mb-4">💬 Ticket Details</h1>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="font-semibold text-xl text-gray-800">{{ $ticket->subject }}</h2>
            <p class="text-gray-600 mt-2">{{ $ticket->description }}</p>
            <p class="text-gray-500 text-sm mt-2">Created by: {{ $ticket->user->name ?? 'N/A' }}</p>
            <p class="text-gray-500 text-sm">Status: {{ ucfirst($ticket->status) }}</p>
            <p class="text-gray-500 text-sm">Created at: {{ $ticket->created_at->format('d M Y H:i') }}</p>
        </div>

        <!-- Comments Section -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Comments</h3>
            @if($ticket->comments->count() > 0)
                <ul class="space-y-4">
                    @foreach($ticket->comments as $comment)
                        <li class="border-b pb-2">
                            <p class="text-gray-800"><span class="font-semibold">{{ $comment->user->name ?? 'N/A' }}:</span> {{ $comment->body }}</p>
                            <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">No comments yet.</p>
            @endif
        </div>

        <!-- Add Comment Form -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Add Comment</h3>
            <form action="{{ route('tickets.comment', $ticket->id) }}" method="POST">
                @csrf
                <textarea name="body" rows="3" class="w-full border border-gray-300 rounded-lg p-2 mb-3" placeholder="Write your comment..." required></textarea>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Submit Comment</button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('admin.tickets.index') }}" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                Back to Tickets
            </a>
        </div>

    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold">{{ $ticket->title }}</h1>
            <p class="mt-2">Status: <strong>{{ ucfirst($ticket->status) }}</strong> | Priority: {{ ucfirst($ticket->priority) }}</p>
            <p class="mt-2">{{ $ticket->description }}</p>

            @if($ticket->attachments->count())
                <div class="mt-4">
                    <h3 class="font-semibold">Attachments:</h3>
                    <ul class="list-disc list-inside">
                        @foreach($ticket->attachments as $file)
                            <li>
                                <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ $file->original_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-semibold text-xl mb-2">Comments</h2>
            @forelse($comments as $comment)
                <div class="border-b py-2">
                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                    <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse

            <form action="{{ route('tickets.comment', $ticket) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="comment" rows="3" class="w-full border rounded px-3 py-2" placeholder="Add a comment..." required></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Comment</button>
            </form>
        </div>
    </div>
</x-app-layout>

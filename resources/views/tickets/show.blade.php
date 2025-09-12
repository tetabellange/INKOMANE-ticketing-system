<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $ticket->title }} - Ticket Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-black text-white min-h-screen flex flex-col items-center p-6" x-data="{ isOpen: false, fileUrl: '' }">

    <!-- Header -->
    <header class="text-center mb-8">
        <h1 class="text-5xl font-extrabold mb-2">🎟 Ticketing System</h1>
        <p class="text-xl">Welcome back, {{ auth()->user()->name }}!</p>
    </header>

    <!-- Ticket Box -->
    <div class="w-full max-w-3xl bg-gray-900 rounded-2xl shadow-lg p-8 space-y-6">

        <!-- Ticket Info -->
        <div>
            <h2 class="text-3xl font-bold mb-2">{{ $ticket->title }}</h2>
            <p class="text-gray-300 mb-2">
                Status: <span class="text-blue-400 font-semibold">{{ ucfirst($ticket->status) }}</span> | 
                Priority: <span class="font-semibold">{{ ucfirst($ticket->priority) }}</span>
            </p>
            <p class="text-gray-200">{{ $ticket->description }}</p>
        </div>

        <!-- Attachments -->
        @if($ticket->attachments->count())
        <div>
            <h3 class="font-semibold text-lg mb-2">Attachments:</h3>
            <ul class="list-disc list-inside space-y-1">
                @foreach($ticket->attachments as $file)
                    <li>
                        <a href="#" 
                           @click.prevent="fileUrl='{{ asset('storage/'.$file->file_path) }}'; isOpen=true"
                           class="text-blue-500 hover:underline">
                           {{ $file->original_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Comments Section -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold mb-3">Comments</h3>
            <div class="space-y-3">
                @forelse($comments as $comment)
                    <div class="border-b border-gray-700 pb-2">
                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                        <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-400">No comments yet.</p>
                @endforelse
            </div>

            <!-- Add Comment Form -->
            <form action="{{ route('tickets.comment', $ticket) }}" method="POST" class="mt-4 space-y-2">
                @csrf
                <textarea name="comment" rows="3" class="w-full rounded-lg px-4 py-2 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Add a comment..." required></textarea>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold">Add Comment</button>
            </form>
        </div>
    </div>

    <!-- Attachment Modal -->
    <div x-show="isOpen" style="display:none" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">
        <div class="bg-gray-900 rounded-2xl p-6 max-w-3xl w-full relative">
            <button @click="isOpen=false" class="absolute top-2 right-2 text-white text-2xl">&times;</button>

            <!-- Image Preview -->
            <template x-if="fileUrl.endsWith('.png') || fileUrl.endsWith('.jpg') || fileUrl.endsWith('.jpeg') || fileUrl.endsWith('.gif')">
                <img :src="fileUrl" class="mx-auto max-h-[70vh] rounded-lg" />
            </template>

            <!-- PDF Preview -->
            <template x-if="fileUrl.endsWith('.pdf')">
                <iframe :src="fileUrl" class="w-full h-[70vh] rounded-lg"></iframe>
            </template>

            <!-- Other Files -->
            <template x-if="!(fileUrl.endsWith('.png') || fileUrl.endsWith('.jpg') || fileUrl.endsWith('.jpeg') || fileUrl.endsWith('.gif') || fileUrl.endsWith('.pdf'))">
                <a :href="fileUrl" target="_blank" class="text-blue-500 underline">Download File</a>
            </template>
        </div>
    </div>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" class="mt-8">
        @csrf
        <button type="submit" class="px-20 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">Logout</button>
    </form>

</body>
</html>

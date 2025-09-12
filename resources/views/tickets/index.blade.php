<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white flex justify-center items-center min-h-screen">

    <div class="w-full max-w-xl space-y-6 p-6">

        <!-- Header -->
        <header class="text-center space-y-2">
            <h1 class="text-3xl font-bold">🎟 Ticketing System</h1>
            <p class="text-gray-300">Welcome back, {{ Auth::user()->name }}!</p>
        </header>

        <!-- Tickets List -->
        <main class="space-y-6">
            @forelse($tickets as $ticket)
                <div class="bg-gray-900 shadow-md rounded-xl p-5 flex justify-between items-center
                            border-l-4 border-{{ $ticket->priority == 'high' ? 'red-500' : ($ticket->priority == 'medium' ? 'yellow-500' : 'green-500') }}
                            transition hover:scale-105 hover:shadow-xl duration-200">
                    
                    <!-- Ticket Details -->
                    <div>
                        <h2 class="font-bold text-xl">{{ $ticket->title }}</h2>
                        <p class="mt-1 text-gray-300">
                            Status: <span class="capitalize text-blue-400">{{ $ticket->status }}</span> | 
                            Priority: <span class="capitalize">{{ $ticket->priority }}</span>
                        </p>
                    </div>

                    <!-- View Button -->
                    <a href="{{ route('tickets.show', $ticket) }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-white font-medium">
                       View
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-400 text-lg">No tickets yet. Create one to get started!</p>
            @endforelse
        </main>

        <!-- Create New Ticket Link -->
        <div class="text-center">
            <a href="{{ route('tickets.create') }}" class="text-blue-500 hover:underline text-lg">
                ➕ Create New Ticket
            </a>
        </div>

        <!-- Logout -->
        <div class="text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                    Logout
                </button>
            </form>
        </div>

    </div>

</body>
</html>

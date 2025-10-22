<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">

        <!-- Header -->
        <div class="bg-green-800 text-gray-100 rounded-lg p-6 shadow">
            <h1 class="text-2xl font-bold">🛠️ Agent Dashboard</h1>
            <p class="mt-2">Welcome, {{ auth()->user()->name }}!</p>
        </div>

        <!-- Success / Status Messages -->
        @if(session('ok'))
            <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                {{ session('ok') }}
            </div>
        @endif

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Ticket Management -->
            <div class="bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Ticket Management</h2>
                <div class="flex flex-wrap gap-4">
                    <!-- Assigned Tickets -->
                    <a href="{{ route('agent.tickets.index') }}" class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">
                        📂 Assigned Tickets
                    </a>
                </div>
            </div>

            <!-- Resources -->
            <div class="bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Resources</h2>
                <a href="{{ route('knowledge-base') }}" class="px-4 py-2 bg-indigo-700 text-white rounded hover:bg-indigo-800">
                    ❓ Help & FAQ
                </a>
            </div>

        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-6 px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800">
                Logout
            </button>
        </form>

    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">
        <!-- Header -->
        <div class="bg-green-700 text-white rounded-lg p-6 shadow">
            <h1 class="text-2xl font-bold">🛠️ Agent Dashboard</h1>
            <p class="mt-2">Welcome, {{ auth()->user()->name }}!</p>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Ticket Management -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Ticket Management</h2>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">📂 Assigned Tickets</a>
                    <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">➕ Create Ticket</a>
                </div>
            </div>

            <!-- Resources -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Resources</h2>
                <a href="/knowledge-base" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">❓ Help & FAQ</a>
            </div>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</button>
        </form>
    </div>
</x-app-layout>

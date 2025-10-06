<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">
        <!-- Header -->
        <div class="bg-purple-700 text-white rounded-lg p-6 shadow">
            <h1 class="text-2xl font-bold">🛒 Customer Dashboard</h1>
            <p class="mt-2">Welcome, {{ auth()->user()->name }}!</p>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Support & Help -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Support & Help</h2>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">➕ Create Ticket</a>
                    <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">📂 My Tickets</a>
                    <a href="{{ route('knowledge-base') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">❓ Help & FAQ</a>
                </div>
            </div>

            <!-- Gift Shop -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Gift Shop</h2>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('shop.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">🛍️ Browse Products</a>
                    <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">🛒 My Cart</a>
                    <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">📦 My Orders</a>
                </div>
            </div>

            <!-- My Activity -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">My Activity</h2>
                <p>🎫 Open Tickets: <strong>Coming Soon</strong></p>
                <p>🛍️ Recent Orders: <strong>Coming Soon</strong></p>
            </div>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</button>
        </form>
    </div>
</x-app-layout>

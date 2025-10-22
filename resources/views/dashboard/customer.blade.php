<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">

        <!-- Header -->
        <div class="bg-purple-800 text-gray-100 rounded-lg p-6 shadow">
            <h1 class="text-2xl font-bold">🛒 Customer Dashboard</h1>
            <p class="mt-2">Welcome, {{ auth()->user()->name }}!</p>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Support & Help -->
            <div class="bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Support & Help</h2>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('customer.tickets.index') }}" class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">📂 My Tickets</a>
<a href="{{ route('customer.tickets.create') }}" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">➕ Create Ticket</a>

                    <a href="{{ route('knowledge-base') }}" class="px-4 py-2 bg-indigo-700 text-white rounded hover:bg-indigo-800">
                        ❓ Help & FAQ
                    </a>
                </div>
            </div>

            <!-- Gift Shop -->
            <div class="bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Gift Shop</h2>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('customer.shop.index') }}" class="px-4 py-2 bg-purple-700 text-white rounded hover:bg-purple-800">🛍️ Browse Products</a>
<a href="{{ route('customer.cart.index') }}" class="px-4 py-2 bg-pink-700 text-white rounded hover:bg-pink-800">🛒 My Cart</a>
<a href="{{ route('customer.orders.index') }}" class="px-4 py-2 bg-yellow-700 text-white rounded hover:bg-yellow-800">📦 My Orders</a>
                </div>
            </div>

            <!-- My Activity -->
            <div class="bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-100">My Activity</h2>
                <p>🎫 Open Tickets: <strong>Coming Soon</strong></p>
                <p>🛍️ Recent Orders: <strong>Coming Soon</strong></p>
            </div>

        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-6 px-6 py-2 bg-red-700 text-white rounded hover:bg-red-800">
                Logout
            </button>
        </form>

    </div>
</x-app-layout>

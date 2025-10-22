<x-app-layout>
    <div class="min-h-screen bg-gray-900 text-gray-100 flex flex-col">

        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 shadow-md p-6">
            <div class="max-w-6xl mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-bold text-green-400">⚙️ Admin Dashboard</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg font-semibold text-white transition">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 py-10 px-6">
            <div class="max-w-6xl mx-auto space-y-8">

                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-xl p-6 shadow-lg border border-gray-700">
                    <p class="text-xl text-gray-300">Welcome, <span class="text-white font-semibold">{{ auth()->user()->name }}</span> 👋</p>
                </div>

                <!-- Grid Sections -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- User Management -->
                    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 shadow-md hover:shadow-green-400/20 transition-all duration-300">
                        <h2 class="text-xl font-semibold mb-4 text-green-400">👥 User Management</h2>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('admin.users.index') }}" 
                               class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg transition">Manage Users</a>
                            <a href="{{ route('admin.roles.index') }}" 
                               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Manage Roles</a>
                        </div>
                    </div>

                    <!-- Ticket Management -->
                    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 shadow-md hover:shadow-green-400/20 transition-all duration-300">
                        <h2 class="text-xl font-semibold mb-4 text-green-400">🎫 Ticket Management</h2>
                        <a href="{{ route('admin.tickets.index') }}" 
                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                           View All Tickets
                        </a>
                    </div>

                    <!-- Shop Management -->
                    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 shadow-md hover:shadow-green-400/20 transition-all duration-300">
                        <h2 class="text-xl font-semibold mb-4 text-green-400">🛍️ Shop Management</h2>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('admin.products.index') }}" 
                               class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                               Manage Products
                            </a>
                            <a href="{{ route('admin.orders.index') }}" 
                               class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-lg transition">
                               Manage Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<!-- resources/views/layouts/app.blade.php -->

<div class="min-h-screen bg-gray-100">
    <!-- ✅ Header with Logout -->
    <div class="flex justify-between items-center p-4 bg-white shadow">
        <h1 class="text-xl font-bold text-purple-700">🎟 Ticketing System</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>

    <!-- ✅ Page content -->
    <main class="p-6">
        {{ $slot }}
    </main>
</div>

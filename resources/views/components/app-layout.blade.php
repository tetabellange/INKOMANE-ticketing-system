<!-- resources/views/layouts/app.blade.php -->

<div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- ✅ Page content -->
    <main class="flex-grow p-6">
        {{ $slot }}
    </main>
</div>

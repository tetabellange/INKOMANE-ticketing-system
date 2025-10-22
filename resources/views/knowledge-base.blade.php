<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-indigo-800 mb-6">❓ Knowledge Base</h1>
        <p class="text-gray-700 mb-6">
            Welcome to the INKOMANE Knowledge Base. Here you can find FAQs, guides, and support articles to help you with your tickets and using the platform.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Example articles -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg text-gray-800 mb-2">How to create a ticket</h2>
                <p class="text-gray-600 text-sm">Step-by-step instructions on submitting a support ticket.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg text-gray-800 mb-2">Checking ticket status</h2>
                <p class="text-gray-600 text-sm">Learn how to track the progress of your tickets.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg text-gray-800 mb-2">Using the Gift Shop</h2>
                <p class="text-gray-600 text-sm">A guide to browse and purchase products from the shop.</p>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                ← Back
            </a>
        </div>
    </div>
</x-app-layout>

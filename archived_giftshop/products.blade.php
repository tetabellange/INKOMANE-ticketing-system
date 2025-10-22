<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">
        <!-- Header -->
        <div class="bg-yellow-600 text-white rounded-lg p-6 shadow">
            <h1 class="text-2xl font-bold">Admin: Products</h1>
            <p class="mt-2">Manage all products below. ✅</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover mb-4">
                    <h2 class="font-semibold text-lg">{{ $product->name }}</h2>
                    <p class="text-gray-700 text-center">{{ $product->description }}</p>
                    <p class="font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm mt-1 text-gray-500">Stock: {{ $product->stock }}</p>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back to Dashboard</a>
    </div>
</x-app-layout>

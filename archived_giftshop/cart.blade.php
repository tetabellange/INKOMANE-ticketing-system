@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="max-w-5xl mx-auto bg-white shadow-md rounded-2xl p-8 mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🛒 My Cart</h1>
        <a href="{{ route('customer.dashboard') }}" 
           class="bg-gray-700 text-white px-5 py-2 rounded-xl hover:bg-gray-800 transition duration-200">
            🏠 Dashboard
        </a>
    </div>

    @if(empty($cartItems) || count($cartItems) === 0)
        <p class="text-gray-500 text-center py-10">Your cart is empty.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border text-left">Product</th>
                        <th class="p-3 border text-left">Price</th>
                        <th class="p-3 border text-left">Quantity</th>
                        <th class="p-3 border text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-3 border font-medium text-gray-800">{{ $item['name'] }}</td>
                        <td class="p-3 border">${{ number_format($item['price'], 2) }}</td>
                        <td class="p-3 border">{{ $item['quantity'] }}</td>
                        <td class="p-3 border font-medium">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-end items-center gap-6">
                <span class="text-lg font-semibold">
                    Total: ${{ number_format(array_reduce($cartItems, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0), 2) }}
                </span>
                <a href="#checkout" 
                   class="bg-black text-white px-5 py-2 rounded-xl hover:bg-gray-800 transition duration-200">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

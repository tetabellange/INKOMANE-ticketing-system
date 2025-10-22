@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-2xl p-8 mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">📦 My Orders</h1>
        <a href="{{ route('customer.dashboard') }}" 
           class="bg-gray-700 text-white px-5 py-2 rounded-xl hover:bg-gray-800 transition duration-200">
            🏠 Dashboard
        </a>
    </div>

    @if(empty($orders) || $orders->isEmpty())
        <p class="text-gray-500 text-center py-10">You have not placed any orders yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border text-left">Order ID</th>
                        <th class="p-3 border text-left">Total</th>
                        <th class="p-3 border text-left">Status</th>
                        <th class="p-3 border text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-3 border font-medium">{{ $order->id }}</td>
                        <td class="p-3 border">${{ number_format($order->total, 2) }}</td>
                        <td class="p-3 border capitalize">
                            <span class="px-3 py-1 rounded-full text-sm 
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                                @elseif($order->status === 'completed') bg-green-100 text-green-700
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>
                        </td>
                        <td class="p-3 border text-gray-600">{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6 text-center">
        <a href="{{ route('customer.dashboard') }}" 
           class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
            ← Back to Dashboard
        </a>
    </div>
</div>
@endsection

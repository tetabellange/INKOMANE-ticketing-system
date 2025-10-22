@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-2xl p-8 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create a New Ticket</h1>

    <!-- Back to Dashboard Button -->
    <div class="mb-4">
        <a href="{{ route('customer.dashboard') }}" class="inline-block px-4 py-2 bg-gray-700 text-white rounded-xl hover:bg-gray-800 transition duration-200">
            🏠 Back to Dashboard
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('customer.tickets.store') }}" class="space-y-5">
        @csrf

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none">
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea id="description" name="description" rows="5" required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none">{{ old('description') }}</textarea>
        </div>

        <!-- Priority -->
        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
            <select id="priority" name="priority" required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none">
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full py-3 bg-black text-white font-medium rounded-xl hover:bg-gray-800 transition duration-200">
            Submit Ticket
        </button>
    </form>

    <!-- Back Links -->
    <div class="text-center mt-6 space-y-2">
        <a href="{{ route('customer.tickets.index') }}" class="text-blue-600 hover:underline text-sm block">
            ← Back to My Tickets
        </a>
        <a href="{{ route('customer.dashboard') }}" class="text-blue-600 hover:underline text-sm block">
            🏠 Back to Dashboard
        </a>
    </div>
</div>
@endsection

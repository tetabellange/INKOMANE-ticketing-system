<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">
        <div class="bg-indigo-600 text-white rounded-lg p-6 shadow">
            <h1 class="text-2xl font-bold">Knowledge Base / Help & FAQ</h1>
            <p class="mt-2">This is a placeholder page for help articles and FAQs. ✅</p>
        </div>
        @if(auth()->user()->role === 'agent')
            <a href="{{ route('agent.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back to Dashboard</a>
        @else
            <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back to Dashboard</a>
        @endif
    </div>
</x-app-layout>

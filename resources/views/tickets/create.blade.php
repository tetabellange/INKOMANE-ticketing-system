<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Create New Ticket</h1>

            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block font-medium">Description</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2" rows="5" required>{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block font-medium">Priority</label>
                    <select name="priority" class="w-full border rounded px-3 py-2" required>
                        <option value="low">Low</option>
                        <option value="normal" selected>Normal</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Attachments (optional)</label>
                    <input type="file" name="attachments[]" multiple class="w-full">
                </div>

                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Create Ticket</button>
            </form>
        </div>
    </div>
</x-app-layout>

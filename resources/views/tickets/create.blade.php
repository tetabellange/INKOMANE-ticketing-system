<!-- resources/views/tickets/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-2xl bg-gray-900 rounded-2xl shadow-lg p-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold mb-6 text-center">🎟 Create New Ticket</h1>

        <!-- Form -->
        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label class="block font-medium mb-1">Title</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}" 
                       placeholder="Enter ticket title"
                       class="w-full rounded-lg px-4 py-2 bg-gray-200 text-black focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" 
                          placeholder="Describe your issue in detail..."
                          class="w-full rounded-lg px-4 py-2 bg-gray-200 text-black focus:outline-none focus:ring-2 focus:ring-blue-500" 
                          rows="5" 
                          required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Priority -->
            <div>
                <label class="block font-medium mb-1">Priority</label>
                <select name="priority" 
                        class="w-full rounded-lg px-4 py-2 bg-gray-200 text-black focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        required>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="normal" {{ old('priority', 'normal') == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
                @error('priority') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Attachments -->
            <div>
                <label class="block font-medium mb-1">Attachments (optional)</label>
                <input type="file" 
                       name="attachments[]" 
                       multiple 
                       class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
                              file:text-sm file:font-semibold file:bg-blue-600 file:text-white 
                              hover:file:bg-blue-700">
                @error('attachments') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('tickets.index') }}" 
                   class="px-6 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-white">
                   Cancel
                </a>

                <button type="submit" 
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-white font-semibold">
                    Create Ticket
                </button>
            </div>
        </form>
    </div>

</body>
</html>

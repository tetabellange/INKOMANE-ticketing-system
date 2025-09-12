<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- ✅ Google Font for special styling -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">

    <!-- Centered Bigger Box -->
    <div class="w-full max-w-xl bg-gray-900 rounded-2xl shadow-lg p-14 text-center">
        
        <!-- Header -->
        <h1 class="text-5xl font-extrabold mb-8">
            Welcome, 
            <span style="font-family: 'Pacifico', cursive;" class="text-blue-400">
                {{ Auth::user()->name }}
            </span>!
        </h1>
        
        <!-- Message -->
        <p class="text-xl text-gray-300 mb-10">
            This is your first time logging in. You can now start creating your tickets.
        </p>
        
        <!-- Button -->
        <a href="{{ url('/tickets') }}" 
           class="px-10 py-4 bg-blue-600 text-white rounded-lg font-semibold text-xl hover:bg-blue-700 transition">
           Go to Tickets
        </a>
    </div>

</body>
</html>

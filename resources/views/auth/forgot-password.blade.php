<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-gray-900 rounded-2xl shadow-lg p-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold mb-4 text-center">🔑 Forgot Password</h1>
        <p class="text-gray-400 text-center mb-6">
            Enter your email address below and we’ll send you a password reset link.
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-green-500 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Enter your email"
                       class="w-full rounded-lg px-4 py-2 bg-gray-200 text-black focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required autofocus>
                @error('email') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" 
                    class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-semibold">
                Send Reset Link
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="text-gray-400 hover:text-blue-400">
                ← Back to Login
            </a>
        </div>
    </div>

</body>
</html>

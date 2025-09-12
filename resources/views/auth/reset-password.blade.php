<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-gray-900 p-8 rounded-2xl shadow-lg text-center">
        <h1 class="text-3xl font-bold mb-6">Reset Password</h1>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email" name="email" placeholder="Enter your email" required
                class="w-full px-4 py-2 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="password" name="password" placeholder="New password" required
                class="w-full px-4 py-2 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="password" name="password_confirmation" placeholder="Confirm password" required
                class="w-full px-4 py-2 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="w-full bg-green-600 py-2 rounded-lg hover:bg-green-700">
                Reset Password
            </button>
        </form>

        <a href="{{ route('login') }}" class="text-blue-400 mt-4 inline-block hover:underline">Back to login</a>
    </div>
</body>
</html>

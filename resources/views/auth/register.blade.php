<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - INKOMANE</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex bg-gray-100">

    <!-- Left Section -->
    <div class="hidden lg:flex flex-1 bg-black text-white flex-col items-center justify-center p-10">
        <img src="{{ asset('images/logo.png') }}" alt="INKOMANE Logo" class="w-48 mb-8">
        <h1 class="text-3xl font-bold tracking-wide">Join INKOMANE</h1>
        <p class="text-gray-400 mt-3">Create an account to get started.</p>
    </div>

    <!-- Right Section -->
    <div class="flex flex-1 items-center justify-center">
        <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Create an account</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded-md mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-md mb-4 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black outline-none">
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-3 bg-black text-white font-medium rounded-xl hover:bg-gray-800 transition duration-200">
                    Register
                </button>
            </form>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
                    Login here
                </a>
            </p>
        </div>
    </div>

</body>
</html>

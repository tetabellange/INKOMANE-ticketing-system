<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INKOMANE - Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-blue-50 to-white text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <h1 class="text-2xl font-extrabold text-black tracking-wide">INKOMANE</h1>
                <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
                    <li><a href="{{ route('welcome') }}" class="hover:text-gray-900 transition">Home</a></li>
                    <li><a href="{{ route('customer.tickets.index') }}" class="hover:text-gray-900 transition">Support</a></li>
                    <li><a href="{{ route('shop.index') }}" class="hover:text-gray-900 transition">Shop</a></li>
                    <li><a href="#" class="hover:text-gray-900 transition">Contact</a></li>
                </ul>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('login') }}" class="px-4 py-2 border border-black text-black rounded-lg font-semibold hover:bg-gray-100 transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-black text-white rounded-lg font-semibold hover:bg-gray-900 transition">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-20 bg-gradient-to-r from-blue-100 via-blue-50 to-indigo-100">
        <h1 class="text-4xl md:text-5xl font-extrabold text-black mb-4 leading-tight">
            Need Help or Want to Shop?<br>You're in the Right Place.
        </h1>
        <p class="text-lg text-gray-800 max-w-2xl mx-auto mb-8">
            INKOMANE is your all-in-one support hub — create tickets, get help, or shop from our official gift store.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('customer.tickets.create') }}" class="px-6 py-3 bg-black text-white font-semibold rounded-lg hover:bg-gray-900 hover:scale-105 transition">
                🎫 Get Support
            </a>
            <a href="{{ route('shop.index') }}" class="px-6 py-3 bg-white border border-black text-black font-semibold rounded-lg hover:bg-gray-100 hover:scale-105 transition">
                🛍️ Visit Shop
            </a>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- Support Card -->
        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
            <h3 class="text-2xl font-bold mb-6 text-black flex items-center gap-2">💬 Support</h3>
            <div class="grid grid-cols-2 gap-4 mb-6 text-center">
                <div class="bg-gray-100 p-4 rounded-lg hover:bg-gray-200 transition">
                    <div class="text-4xl mb-2">🎫</div>
                    <p class="font-semibold text-black">Create Ticket</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg hover:bg-gray-200 transition">
                    <div class="text-4xl mb-2">📄</div>
                    <p class="font-semibold text-black">Check Status</p>
                </div>
            </div>
            <ul class="space-y-2 text-gray-800">
                <li class="flex items-center gap-2"><span class="text-green-600">✔</span> Fast Support</li>
                <li class="flex items-center gap-2"><span class="text-green-600">✔</span> 24/7 Helpline Access</li>
                <li class="flex items-center gap-2"><span class="text-green-600">✔</span> Secure Payments via Stripe & PayPal</li>
            </ul>
            <a href="{{ route('customer.tickets.create') }}" class="mt-6 inline-block w-full text-center bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-900 transition">Open Ticket</a>
        </div>

        <!-- Shop Card (First 2 products) -->
        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
            <h3 class="text-2xl font-bold mb-6 text-black flex items-center gap-2">🛒 Gift Shop</h3>
            <div class="grid grid-cols-2 gap-6">
                @foreach($products as $product)
                    <div class="text-center border border-gray-300 rounded-xl p-4 hover:bg-gray-100 transition">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="mx-auto rounded-lg mb-3 h-48 w-auto object-contain">
                        <p class="font-semibold text-black">{{ $product->name }}</p>
                        <p class="text-gray-800">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('shop.index') }}" class="mt-2 inline-block px-3 py-1 bg-black text-white rounded-lg hover:bg-gray-900 transition">
                            Shop Now
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10 mt-10">
        <div class="max-w-6xl mx-auto text-center space-y-3">
            <p class="text-lg font-semibold text-white">INKOMANE Customer Support & Gift Shop</p>
            <p>© 2025 INKOMANE. All rights reserved.</p>
            <div class="flex justify-center gap-6 text-xl">
                <a href="#" class="hover:text-white transition">🐦</a>
                <a href="#" class="hover:text-white transition">📘</a>
                <a href="#" class="hover:text-white transition">📸</a>
            </div>
        </div>
    </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>INKOMANE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <main class="flex-grow p-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>

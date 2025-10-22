<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>INKOMANE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">
    <!-- Main Wrapper -->
    <div class="flex-grow flex flex-col">
        <main class="flex-grow p-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>

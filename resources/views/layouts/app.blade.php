<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tools & Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">Tools & Blog</a>
            <div class="space-x-4">
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
                <a href="{{ route('tools') }}" class="hover:underline">Tools</a>
                <a href="{{ route('blog') }}" class="hover:underline">Blog</a>
                <a href="{{ route('contact.show') }}" class="hover:underline">Contact</a>
                <a href="{{ route('privacy') }}" class="hover:underline">Privacy</a>
                <a href="{{ route('terms') }}" class="hover:underline">Terms</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center">
        <p>&copy; {{ date('Y') }} Tools & Blog. All rights reserved.</p>
    </footer>
</body>
</html>
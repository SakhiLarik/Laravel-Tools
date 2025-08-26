<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tools & Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset("asset/computer.png")}}" />
    <style>

    .btn {
    background-color: #374151; /* bg-gray-700 */
    color: white; /* text-white */
    font-weight: 500; /* font-bold */
    font-size: small;
    padding-top: 0.75rem; /* py-3 */
    padding-bottom: 0.75rem;
    padding-left: 0.5rem; /* px-2 */
    padding-right: 0.5rem;
    border-radius: 0.5rem; /* rounded-lg */
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -1px rgb(0 0 0 / 0.06); /* shadow-md */
    transition-property: background-color;
    transition-duration: 200ms;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); /* ease-in-out */
}

.btn:hover {
    background-color: #4b5563; /* hover:bg-gray-600 */
}

.btn:active {
    background-color: #6b7280; /* active:bg-gray-500 */
}

.num {
    background-color: #4b5563; /* bg-gray-600 */
}

.num:hover {
    background-color: #6b7280; /* hover:bg-gray-500 */
}

.op {
    background-color: #2563eb; /* bg-blue-600 */
}

.op:hover {
    background-color: #3b82f6; /* hover:bg-blue-500 */
}

.func {
    background-color: #16a34a; /* bg-green-600 */
}

.func:hover {
    background-color: #22c55e; /* hover:bg-green-500 */
}

.clear {
    background-color: #dc2626; /* bg-red-600 */
}

.clear:hover {
    background-color: #ef4444; /* hover:bg-red-500 */
}

.equal {
    background-color: #f97316; /* bg-orange-600 */
}

.equal:hover {
    background-color: #fb923c; /* hover:bg-orange-500 */
}


    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
   <nav class="bg-blue-600 text-white p-4 px-6 md:px-20">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <div class="flex">
    <a href="{{ route('home') }}" class="text-2xl font-bold">Tools & Blog</a>
    </div>
    
    <!-- Hamburger button (visible on small screens) -->
    <button id="menu-btn" class="md:hidden focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
           viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <!-- Menu Links -->
    <div id="menu" class="hidden md:flex space-x-6">
      <a href="{{ route('home') }}" class="hover:underline">Home</a>
      <a href="{{ route('tools') }}" class="hover:underline">Tools</a>
      <a href="{{ route('blog') }}" class="hover:underline">Blog</a>
      <a href="{{ route('contact.show') }}" class="hover:underline">Contact</a>
      <a href="{{ route('privacy') }}" class="hover:underline">Privacy</a>
      <a href="{{ route('terms') }}" class="hover:underline">Terms</a>
    </div>
  </div>

  <!-- Mobile menu (hidden by default) -->
  <div id="mobile-menu" class="md:hidden hidden mt-4 px-6 space-y-2">
    <a href="{{ route('home') }}" class="block hover:underline">Home</a>
    <a href="{{ route('tools') }}" class="block hover:underline">Tools</a>
    <a href="{{ route('blog') }}" class="block hover:underline">Blog</a>
    <a href="{{ route('contact.show') }}" class="block hover:underline">Contact</a>
    <a href="{{ route('privacy') }}" class="block hover:underline">Privacy</a>
    <a href="{{ route('terms') }}" class="block hover:underline">Terms</a>
  </div>
</nav>

<script>
  const btn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  btn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>


    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center">
        <p>&copy; {{ date('Y') }} Tools & Blog. All rights reserved.</p>
    </footer>
</body>
</html>
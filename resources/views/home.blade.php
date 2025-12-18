@extends('layouts.app')

@section('title', 'Free Online Tools Hub | MyToolsHub.online')

@section('content')
<div class="text-center py-12">
    <header class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">All-in-One Digital Toolbox</h1>
            <p class="text-xl opacity-90 mb-8">Fast, free, and secure online tools for developers, content creators, and students.</p>
            <div class="flex justify-center gap-4">
                <a href="/tools" class="bg-white text-blue-700 px-10 py-5 rounded-lg font-semibold shadow-lg duration-300 hover:text-white hover:bg-blue-700 transition-all outline-white">Explore All Tools</a>
            </div>
        </div>
    </header>

    <section id="popular" class="py-16 max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 flex items-center">
            <i class="fa-solid fa-fire text-orange-500 mr-3"></i> Popular Tools
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($tools as $tool)
                <div class="bg-white rounded-xl border border-gray-200 hover:shadow-xl transition group">
                    <a href="{{ $tool['url'] }}" class=" p-6 d-block block">
                        <div
                            class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition">
                            <span class="{{ $tool['icon'] }}"></span>
                        </div>
                        <h3 class="font-bold text-lg mb-2">{{ $tool['name'] }}</h3>
                        <p class="text-gray-500 text-sm mb-4">{{ $tool['description'] }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center gap-4 my-10">
                <a href="/tools" class="bg-white text-blue-700 px-10 py-5 rounded-lg font-semibold shadow-lg duration-300 hover:text-white hover:bg-blue-700 transition-all text-3xl">Explore All Tools</a>
            </div>
    </section>
</div>
@endsection
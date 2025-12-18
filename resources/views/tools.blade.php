@extends('layouts.app')

@section('title', 'Tools')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-4">Our Tools</h1>
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
    </div>
@endsection

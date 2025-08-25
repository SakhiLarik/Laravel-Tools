@extends('layouts.app')

@section('title', 'Tools')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Our Tools</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($tools as $tool)
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $tool['name'] }}</h2>
                <p class="text-gray-600 mb-4">{{ $tool['description'] }}</p>
                <a href="{{ $tool['url'] }}" class="text-blue-600 hover:underline">Try it now</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
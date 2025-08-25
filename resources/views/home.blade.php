@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center py-12">
    <h1 class="text-4xl font-bold mb-4">Welcome to Tools & Blog</h1>
    <p class="text-lg mb-6">Explore our collection of useful tools and insightful blog posts.</p>
    <div class="flex justify-center space-x-4">
        <a href="{{ route('tools') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">View Tools</a>
        <a href="{{ route('blog') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">Read Blog</a>
    </div>
</div>
@endsection
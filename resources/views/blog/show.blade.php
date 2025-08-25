@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Blog Posts</h1>
    <div class="space-y-6">
        @foreach ($posts as $post)
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold">
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 hover:underline">{{ $post->title }}</a>
                </h2>
                <p class="text-gray-600">{{ Str::limit($post->content, 150) }}</p>
                <p class="text-sm text-gray-500">Posted on {{ $post->created_at->format('M d, Y') }}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
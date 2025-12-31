@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Contact Us</h1>
        
        <p class="text-gray-700 mb-6">Have questions about our tools or need support? Get in touch with us using the form below. We're here to help!</p>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4"> <!-- Add a route/controller for submission -->
                @csrf <!-- Laravel CSRF protection -->
                @method("post")
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{old('name')}}">
                    @error('name')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Your Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{old('email')}}">
                    @error('email')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{old('subject')}}">
                    @error('subject')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{old('message')}}</textarea>
                    @error('message')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Send Message</button>
            </form>
        </div>
        
        <!--<div class="mt-8 text-gray-700">-->
        <!--    <p><strong>Address:</strong> [Your Address, City, State, ZIP Code]</p>-->
        <!--    <p><strong>Phone:</strong> [Your Phone Number]</p>-->
        <!--    <p><strong>Email:</strong> [your-email@example.com]</p>-->
        <!--</div>-->
    </div>
@endsection
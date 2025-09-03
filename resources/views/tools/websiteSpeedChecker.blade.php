@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Website Speed Checker</h1>
            
            <div class="mb-6">
                <label for="url" class="block text-sm font-medium text-gray-700 mb-2">Enter Website URL:</label>
                <input type="url" id="url" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., https://example.com">
            </div>
            
            <button id="check-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Check Speed</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800 hidden">
                <p>Load Time: <span id="load-time">0</span> ms</p>
                <p>Page Size: <span id="page-size">0</span> KB</p>
                <p>Status: <span id="status">Pending</span></p>
            </div>
            <p id="error-message" class="text-red-500 text-center mt-4 hidden">Error: Invalid URL or unable to fetch data.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlInput = document.getElementById('url');
        const checkBtn = document.getElementById('check-btn');
        const resultDiv = document.getElementById('result');
        const loadTimeSpan = document.getElementById('load-time');
        const pageSizeSpan = document.getElementById('page-size');
        const statusSpan = document.getElementById('status');
        const errorMessage = document.getElementById('error-message');

        async function checkWebsiteSpeed() {
            const url = urlInput.value.trim();
            if (!url || !url.match(/^https?:\/\//)) {
                errorMessage.textContent = 'Please enter a valid URL starting with http:// or https://';
                errorMessage.classList.remove('hidden');
                return;
            }

            resultDiv.classList.add('hidden');
            errorMessage.classList.add('hidden');
            statusSpan.textContent = 'Checking...';
            resultDiv.classList.remove('hidden');

            try {
                const startTime = performance.now();
                const response = await fetch(url, { method: 'HEAD', mode: 'cors' });
                const endTime = performance.now();
                const loadTime = (endTime - startTime).toFixed(2);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const contentLength = response.headers.get('content-length');
                const pageSize = contentLength ? (contentLength / 1024).toFixed(2) : 'N/A';
                const status = response.status === 200 ? 'Success' : 'Partial Success';

                loadTimeSpan.textContent = loadTime;
                pageSizeSpan.textContent = pageSize;
                statusSpan.textContent = status;
            } catch (error) {
                errorMessage.textContent = `Error: ${error.message}. Ensure the URL is correct and CORS is allowed.`;
                errorMessage.classList.remove('hidden');
            }
        }

        checkBtn.addEventListener('click', checkWebsiteSpeed);

        // Handle enter key
        urlInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') checkWebsiteSpeed();
        });
    });
</script>
@endsection
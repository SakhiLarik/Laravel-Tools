@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">QR Code Generator</h1>
            
            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Select Type:</label>
                <select id="type" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="text">Text</option>
                    <option value="url">URL/Link</option>
                    <option value="file">File (Upload & Get URL QR)</option>
                </select>
            </div>
            
            <div id="input-container" class="mb-6">
                <!-- Dynamic inputs will be placed here -->
            </div>
            
            <button id="generate-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Generate QR Code</button>
            
            <div id="qrcode" class="flex justify-center"></div>
            <div id="download-container" class="flex justify-center mt-4"></div>
            <p id="error-message" class="text-red-500 text-center mt-4 hidden">Error: File too large, invalid input, or processing failed.</p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const inputContainer = document.getElementById('input-container');
        const generateBtn = document.getElementById('generate-btn');
        const qrcodeDiv = document.getElementById('qrcode');
        const downloadContainer = document.getElementById('download-container');
        const errorMessage = document.getElementById('error-message');

        let qrcode = null;

        function updateInput() {
            inputContainer.innerHTML = '';
            const type = typeSelect.value;

            if (type === 'text') {
                const textarea = document.createElement('textarea');
                textarea.id = 'text-input';
                textarea.rows = 4;
                textarea.classList.add('w-full', 'p-3', 'border', 'border-gray-300', 'rounded-md', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500');
                textarea.placeholder = 'Enter text here...';
                inputContainer.appendChild(textarea);
            } else if (type === 'url') {
                const input = document.createElement('input');
                input.id = 'url-input';
                input.type = 'url';
                input.classList.add('w-full', 'p-3', 'border', 'border-gray-300', 'rounded-md', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500');
                input.placeholder = 'Enter URL here (e.g., https://example.com)';
                inputContainer.appendChild(input);
            } else if (type === 'file') {
                const input = document.createElement('input');
                input.id = 'file-input';
                input.type = 'file';
                input.classList.add('w-full', 'p-3', 'border', 'border-gray-300', 'rounded-md', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-500');
                input.accept = '*'; // Allow all file types
                inputContainer.appendChild(input);
            }
        }

        function generateQR() {
            const type = typeSelect.value;
            let data = '';

            errorMessage.classList.add('hidden');
            qrcodeDiv.innerHTML = '';
            downloadContainer.innerHTML = '';

            if (type === 'text') {
                data = document.getElementById('text-input')?.value.trim();
                if (!data) {
                    errorMessage.textContent = 'Please enter some text.';
                    errorMessage.classList.remove('hidden');
                    return;
                }
                createQRCode(data);
            } else if (type === 'url') {
                data = document.getElementById('url-input')?.value.trim();
                if (!data) {
                    errorMessage.textContent = 'Please enter a URL.';
                    errorMessage.classList.remove('hidden');
                    return;
                }
                if (!data.match(/^https?:\/\//)) {
                    data = 'https://' + data;
                }
                createQRCode(data);
            } else if (type === 'file') {
                const fileInput = document.getElementById('file-input');
                if (!fileInput.files[0]) {
                    errorMessage.textContent = 'Please select a file.';
                    errorMessage.classList.remove('hidden');
                    return;
                }
                const file = fileInput.files[0];
                if (file.size > 10 * 1024 * 1024) { // 10MB limit
                    errorMessage.textContent = 'File too large. Please select a file under 10MB.';
                    errorMessage.classList.remove('hidden');
                    return;
                }

                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token for Laravel

                fetch('/upload', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.url) {
                        createQRCode(result.url);
                    } else {
                        errorMessage.textContent = 'Upload failed. Please try again.';
                        errorMessage.classList.remove('hidden');
                    }
                })
                .catch(() => {
                    errorMessage.textContent = 'Error uploading file.';
                    errorMessage.classList.remove('hidden');
                });
            }
        }

        function createQRCode(data) {
            try {
                if (qrcode) qrcode.clear(); // Clear previous QR code if exists
                qrcode = new QRCode(qrcodeDiv, {
                    text: data,
                    width: 256,
                    height: 256,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });

                // Add download button
                const downloadBtn = document.createElement('button');
                downloadBtn.textContent = 'Download QR Code';
                downloadBtn.classList.add('px-4', 'py-2', 'bg-green-500', 'text-white', 'font-medium', 'rounded-md', 'hover:bg-green-600', 'focus:outline-none', 'focus:ring-2', 'focus:ring-green-500');
                downloadBtn.addEventListener('click', () => {
                    const canvas = qrcodeDiv.querySelector('canvas');
                    if (canvas) {
                        const link = document.createElement('a');
                        link.href = canvas.toDataURL('image/png');
                        link.download = 'qrcode.png';
                        link.click();
                    }
                });
                downloadContainer.appendChild(downloadBtn);
            } catch (e) {
                errorMessage.textContent = 'Failed to generate QR code. Try a different input.';
                errorMessage.classList.remove('hidden');
                console.error(e);
            }
        }

        typeSelect.addEventListener('change', updateInput);
        generateBtn.addEventListener('click', generateQR);

        // Initial update
        updateInput();
    });
</script>
@endsection
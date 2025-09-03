@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">IP Address Finder</h1>
            
            <div class="mb-6">
                <label for="ip-input" class="block text-sm font-medium text-gray-700 mb-2">Enter IP Address (Optional):</label>
                <input type="text" id="ip-input" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., 192.168.1.1 or leave blank for your IP">
            </div>
            
            <button id="find-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Find IP Details</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800 hidden">
                <p>IP Address: <span id="ip-address">N/A</span></p>
                <p>Country: <span id="country">N/A</span></p>
                <p>City: <span id="city">N/A</span></p>
                <p>Region: <span id="region">N/A</span></p>
                <p>ISP: <span id="isp">N/A</span></p>
                <p>Latitude: <span id="latitude">N/A</span></p>
                <p>Longitude: <span id="longitude">N/A</span></p>
                <p>Time Zone: <span id="timezone">N/A</span></p>
            </div>
            <p id="error-message" class="text-red-500 text-center mt-4 hidden">Error: Invalid IP address or unable to fetch data.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ipInput = document.getElementById('ip-input');
        const findBtn = document.getElementById('find-btn');
        const resultDiv = document.getElementById('result');
        const ipAddressSpan = document.getElementById('ip-address');
        const countrySpan = document.getElementById('country');
        const citySpan = document.getElementById('city');
        const regionSpan = document.getElementById('region');
        const ispSpan = document.getElementById('isp');
        const latitudeSpan = document.getElementById('latitude');
        const longitudeSpan = document.getElementById('longitude');
        const timezoneSpan = document.getElementById('timezone');
        const errorMessage = document.getElementById('error-message');

        async function findIpDetails() {
            const ip = ipInput.value.trim();
            const isValidIp = ip === '' || /^(\d{1,3}\.){3}\d{1,3}$/.test(ip); // Basic IP validation
            if (ip !== '' && !isValidIp) {
                errorMessage.textContent = 'Please enter a valid IP address (e.g., 192.168.1.1) or leave blank.';
                errorMessage.classList.remove('hidden');
                return;
            }

            resultDiv.classList.add('hidden');
            errorMessage.classList.add('hidden');
            findBtn.textContent = 'Finding...';
            findBtn.disabled = true;

            try {
                const response = await fetch(`https://ipapi.co/${ip || ''}/json/`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                if (data.error) {
                    throw new Error(data.reason || 'Invalid IP or API limit reached.');
                }

                ipAddressSpan.textContent = data.ip || 'N/A';
                countrySpan.textContent = data.country_name || 'N/A';
                citySpan.textContent = data.city || 'N/A';
                regionSpan.textContent = data.region || 'N/A';
                ispSpan.textContent = data.org || 'N/A';
                latitudeSpan.textContent = data.latitude || 'N/A';
                longitudeSpan.textContent = data.longitude || 'N/A';
                timezoneSpan.textContent = data.timezone || 'N/A';

                resultDiv.classList.remove('hidden');
            } catch (error) {
                errorMessage.textContent = `Error: ${error.message}. Try again or check your internet connection.`;
                errorMessage.classList.remove('hidden');
            } finally {
                findBtn.textContent = 'Find IP Details';
                findBtn.disabled = false;
            }
        }

        findBtn.addEventListener('click', findIpDetails);

        // Handle enter key
        ipInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') findIpDetails();
        });

        // Auto-detect user's IP on page load
        findIpDetails();
    });
</script>
@endsection
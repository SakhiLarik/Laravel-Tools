@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Time Zone Converter</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="from-timezone" class="block text-sm font-medium text-gray-700 mb-2">From Time Zone:</label>
                    <select id="from-timezone" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></select>
                </div>
                <div>
                    <label for="to-timezone" class="block text-sm font-medium text-gray-700 mb-2">To Time Zone:</label>
                    <select id="to-timezone" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></select>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="date-time" class="block text-sm font-medium text-gray-700 mb-2">Enter Date and Time:</label>
                <input type="datetime-local" id="date-time" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="2025-09-03T16:11">
            </div>
            
            <button id="convert-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Convert Time</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800">
                Converted Time: <span id="converted-time">N/A</span>
            </div>
            <p id="error-message" class="text-red-500 text-center mt-4 hidden">Error: Invalid input or unable to convert time.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fromTimezoneSelect = document.getElementById('from-timezone');
        const toTimezoneSelect = document.getElementById('to-timezone');
        const dateTimeInput = document.getElementById('date-time');
        const convertBtn = document.getElementById('convert-btn');
        const convertedTimeSpan = document.getElementById('converted-time');
        const errorMessage = document.getElementById('error-message');

        // Populate time zones
        const timeZones = [
            "Pacific/Midway", "Pacific/Honolulu", "America/Anchorage", "America/Los_Angeles", "America/Denver",
            "America/Chicago", "America/New_York", "America/Sao_Paulo", "Atlantic/Azores", "Europe/London",
            "Europe/Paris", "Europe/Istanbul", "Asia/Dubai", "Asia/Karachi", "Asia/Dhaka", "Asia/Bangkok",
            "Asia/Tokyo", "Australia/Sydney", "Pacific/Auckland", "Pacific/Kiritimati"
        ];

        timeZones.forEach(timezone => {
            const option1 = document.createElement('option');
            option1.value = timezone;
            option1.textContent = timezone;
            fromTimezoneSelect.appendChild(option1);

            const option2 = document.createElement('option');
            option2.value = timezone;
            option2.textContent = timezone;
            toTimezoneSelect.appendChild(option2);
        });

        // Set default time zones (e.g., Karachi and New York)
        fromTimezoneSelect.value = 'Asia/Karachi';
        toTimezoneSelect.value = 'America/New_York';

        function convertTime() {
            const fromTimezone = fromTimezoneSelect.value;
            const toTimezone = toTimezoneSelect.value;
            const dateTimeStr = dateTimeInput.value;

            if (!dateTimeStr) {
                errorMessage.textContent = 'Please enter a date and time.';
                errorMessage.classList.remove('hidden');
                return;
            }

            try {
                const date = new Date(dateTimeStr);
                if (isNaN(date.getTime())) {
                    throw new Error('Invalid date and time format.');
                }

                // Convert to target timezone
                const options = { timeZone: toTimezone, hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit', year: 'numeric', month: '2-digit', day: '2-digit' };
                const convertedDate = new Date(date.toLocaleString('en-US', { timeZone: fromTimezone })).toLocaleString('en-US', options);

                convertedTimeSpan.textContent = convertedDate.replace(/(\d+)\/(\d+)\/(\d+)/, '$3-$2-$1'); // Reformat to YYYY-MM-DD HH:MM:SS
                errorMessage.classList.add('hidden');
            } catch (error) {
                errorMessage.textContent = `Error: ${error.message}`;
                errorMessage.classList.remove('hidden');
            }
        }

        convertBtn.addEventListener('click', convertTime);

        // Handle enter key
        dateTimeInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') convertTime();
        });

        // Initial conversion with default values
        convertTime();
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">AdSense Earnings Calculator</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="page-views" class="block text-sm font-medium text-gray-700 mb-2">Monthly Page Views:</label>
                    <input type="number" id="page-views" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="1" min="0" placeholder="e.g., 10000">
                </div>
                <div>
                    <label for="cpm" class="block text-sm font-medium text-gray-700 mb-2">CPM (Cost Per Mille, $):</label>
                    <input type="number" id="cpm" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01" min="0" placeholder="e.g., 2.50">
                </div>
                <div>
                    <label for="ctr" class="block text-sm font-medium text-gray-700 mb-2">CTR (Click-Through Rate, %):</label>
                    <input type="number" id="ctr" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.1" min="0" max="100" placeholder="e.g., 1.5">
                </div>
                <div>
                    <label for="rpc" class="block text-sm font-medium text-gray-700 mb-2">RPC (Revenue Per Click, $):</label>
                    <input type="number" id="rpc" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01" min="0" placeholder="e.g., 0.25">
                </div>
            </div>
            
            <button id="calculate-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Calculate Earnings</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800">
                <p>Estimated Monthly Earnings: <span id="monthly-earnings">N/A</span> USD</p>
                <p>Estimated Daily Earnings: <span id="daily-earnings">N/A</span> USD</p>
            </div>
            <p id="error-message" class="text-red-500 text-center mt-4 hidden">Error: Please enter valid positive values for all fields.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pageViewsInput = document.getElementById('page-views');
        const cpmInput = document.getElementById('cpm');
        const ctrInput = document.getElementById('ctr');
        const rpcInput = document.getElementById('rpc');
        const calculateBtn = document.getElementById('calculate-btn');
        const monthlyEarningsSpan = document.getElementById('monthly-earnings');
        const dailyEarningsSpan = document.getElementById('daily-earnings');
        const errorMessage = document.getElementById('error-message');

        function calculateEarnings() {
            const pageViews = parseFloat(pageViewsInput.value);
            const cpm = parseFloat(cpmInput.value);
            const ctr = parseFloat(ctrInput.value);
            const rpc = parseFloat(rpcInput.value);

            if (isNaN(pageViews) || isNaN(cpm) || isNaN(ctr) || isNaN(rpc) ||
                pageViews < 0 || cpm < 0 || ctr < 0 || ctr > 100 || rpc < 0) {
                errorMessage.classList.remove('hidden');
                monthlyEarningsSpan.textContent = 'N/A';
                dailyEarningsSpan.textContent = 'N/A';
                return;
            }

            errorMessage.classList.add('hidden');

            // Method 1: Using CPM (Earnings = Page Views * CPM / 1000)
            const earningsFromCPM = (pageViews * cpm) / 1000;

            // Method 2: Using CTR and RPC (Earnings = Page Views * CTR% * RPC)
            const clicks = (pageViews * ctr) / 100;
            const earningsFromCTR = clicks * rpc;

            // Average the two methods for a balanced estimate
            const monthlyEarnings = ((earningsFromCPM + earningsFromCTR) / 2).toFixed(2);
            const dailyEarnings = (monthlyEarnings / 30).toFixed(2); // Assuming 30 days/month

            monthlyEarningsSpan.textContent = monthlyEarnings;
            dailyEarningsSpan.textContent = dailyEarnings;
        }

        calculateBtn.addEventListener('click', calculateEarnings);

        // Handle enter key on any input
        [pageViewsInput, cpmInput, ctrInput, rpcInput].forEach(input => {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') calculateEarnings();
            });
        });

        // Initial calculation with empty values
        calculateEarnings();
    });
</script>
@endsection
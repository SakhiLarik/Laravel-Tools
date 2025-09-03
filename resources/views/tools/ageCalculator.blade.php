@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Age Calculator</h1>
            
            <div class="mb-6">
                <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth:</label>
                <input type="date" id="dob" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button id="calculate-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Calculate Age</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dobInput = document.getElementById('dob');
        const calculateBtn = document.getElementById('calculate-btn');
        const resultDiv = document.getElementById('result');

        function calculateAge() {
            const dob = new Date(dobInput.value);
            if (!dobInput.value) {
                resultDiv.textContent = 'Please select a date of birth.';
                return;
            }

            const today = new Date();
            let ageYears = today.getFullYear() - dob.getFullYear();
            let ageMonths = today.getMonth() - dob.getMonth();
            let ageDays = today.getDate() - dob.getDate();

            // Adjust for negative months or days
            if (ageDays < 0) {
                ageMonths--;
                const lastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
                ageDays += lastMonth.getDate();
            }
            if (ageMonths < 0) {
                ageYears--;
                ageMonths += 12;
            }

            // Ensure valid age
            if (ageYears < 0) {
                resultDiv.textContent = 'Date of birth cannot be in the future.';
                return;
            }

            resultDiv.textContent = `You are ${ageYears} years, ${ageMonths} months, and ${ageDays} days old.`;
        }

        calculateBtn.addEventListener('click', calculateAge);

        // Handle enter key
        dobInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') calculateAge();
        });
    });
</script>
@endsection
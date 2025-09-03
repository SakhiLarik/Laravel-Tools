@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">BMI Calculator</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">Weight (kg):</label>
                    <input type="number" id="weight" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.1" placeholder="e.g., 70.5" min="0">
                </div>
                <div>
                    <label for="height" class="block text-sm font-medium text-gray-700 mb-2">Height (cm):</label>
                    <input type="number" id="height" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.1" placeholder="e.g., 175.5" min="0">
                </div>
            </div>
            
            <button id="calculate-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Calculate BMI</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800">
                <p>BMI: <span id="bmi-value">N/A</span></p>
                <p>Category: <span id="bmi-category">N/A</span></p>
            </div>
            <p id="error-message" class="text-red-500 text-center mt-4 hidden">Error: Please enter valid weight and height values (greater than 0).</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const weightInput = document.getElementById('weight');
        const heightInput = document.getElementById('height');
        const calculateBtn = document.getElementById('calculate-btn');
        const bmiValueSpan = document.getElementById('bmi-value');
        const bmiCategorySpan = document.getElementById('bmi-category');
        const errorMessage = document.getElementById('error-message');

        function calculateBMI() {
            const weight = parseFloat(weightInput.value);
            const height = parseFloat(heightInput.value);

            if (isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
                errorMessage.classList.remove('hidden');
                bmiValueSpan.textContent = 'N/A';
                bmiCategorySpan.textContent = 'N/A';
                return;
            }

            errorMessage.classList.add('hidden');

            // BMI = weight (kg) / (height (m) * height (m))
            const heightInMeters = height / 100; // Convert cm to meters
            const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);

            bmiValueSpan.textContent = bmi;

            // Determine BMI category
            let category;
            if (bmi < 18.5) category = 'Underweight';
            else if (bmi < 25) category = 'Normal weight';
            else if (bmi < 30) category = 'Overweight';
            else category = 'Obese';

            bmiCategorySpan.textContent = category;
        }

        calculateBtn.addEventListener('click', calculateBMI);

        // Handle enter key
        weightInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') calculateBMI();
        });
        heightInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') calculateBMI();
        });

        // Initial calculation with empty values
        calculateBMI();
    });
</script>
@endsection
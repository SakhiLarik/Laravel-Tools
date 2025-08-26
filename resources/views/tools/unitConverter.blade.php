@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Advanced Unit Converter</h1>
            
            <div class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Select Category:</label>
                <select id="category" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="length">Length</option>
                    <option value="mass">Mass</option>
                    <option value="temperature">Temperature</option>
                    <option value="area">Area</option>
                    <option value="volume">Volume</option>
                    <option value="speed">Speed</option>
                    <option value="time">Time</option>
                    <option value="pressure">Pressure</option>
                    <option value="energy">Energy</option>
                </select>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="from-unit" class="block text-sm font-medium text-gray-700 mb-2">From Unit:</label>
                    <select id="from-unit" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></select>
                </div>
                <div>
                    <label for="to-unit" class="block text-sm font-medium text-gray-700 mb-2">To Unit:</label>
                    <select id="to-unit" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></select>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="input-value" class="block text-sm font-medium text-gray-700 mb-2">Enter Value:</label>
                <input type="number" id="input-value" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="any">
            </div>
            
            <button id="convert-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Convert</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const fromUnitSelect = document.getElementById('from-unit');
        const toUnitSelect = document.getElementById('to-unit');
        const inputValue = document.getElementById('input-value');
        const convertBtn = document.getElementById('convert-btn');
        const resultDiv = document.getElementById('result');

        const units = {
            length: {
                base: 'meter',
                factors: {
                    meter: 1,
                    kilometer: 1000,
                    centimeter: 0.01,
                    millimeter: 0.001,
                    micrometer: 1e-6,
                    nanometer: 1e-9,
                    mile: 1609.34,
                    yard: 0.9144,
                    foot: 0.3048,
                    inch: 0.0254
                }
            },
            mass: {
                base: 'kilogram',
                factors: {
                    kilogram: 1,
                    gram: 0.001,
                    milligram: 1e-6,
                    microgram: 1e-9,
                    tonne: 1000,
                    pound: 0.453592,
                    ounce: 0.0283495,
                    stone: 6.35029
                }
            },
            temperature: {
                // Special handling, no factors
            },
            area: {
                base: 'square_meter',
                factors: {
                    'square_meter': 1,
                    'square_kilometer': 1e6,
                    'square_centimeter': 1e-4,
                    'square_millimeter': 1e-6,
                    hectare: 10000,
                    acre: 4046.86,
                    'square_mile': 2.58999e6,
                    'square_yard': 0.836127,
                    'square_foot': 0.092903,
                    'square_inch': 0.00064516
                }
            },
            volume: {
                base: 'cubic_meter',
                factors: {
                    'cubic_meter': 1,
                    'cubic_centimeter': 1e-6,
                    'cubic_millimeter': 1e-9,
                    liter: 0.001,
                    milliliter: 1e-6,
                    'cubic_foot': 0.0283168,
                    'cubic_inch': 1.6387e-5,
                    gallon_us: 0.00378541,
                    gallon_uk: 0.00454609,
                    pint_us: 0.000473176,
                    pint_uk: 0.000568261
                }
            },
            speed: {
                base: 'meter_per_second',
                factors: {
                    'meter_per_second': 1,
                    'kilometer_per_hour': 1 / 3.6,
                    'mile_per_hour': 0.44704,
                    'foot_per_second': 0.3048,
                    knot: 0.514444
                }
            },
            time: {
                base: 'second',
                factors: {
                    second: 1,
                    millisecond: 0.001,
                    minute: 60,
                    hour: 3600,
                    day: 86400,
                    week: 604800,
                    month: 2628000, // approx 30.4167 days
                    year: 31536000 // non-leap
                }
            },
            pressure: {
                base: 'pascal',
                factors: {
                    pascal: 1,
                    kilopascal: 1000,
                    bar: 100000,
                    atmosphere: 101325,
                    psi: 6894.76,
                    torr: 133.322,
                    mmhg: 133.322
                }
            },
            energy: {
                base: 'joule',
                factors: {
                    joule: 1,
                    kilojoule: 1000,
                    calorie: 4.184,
                    kilocalorie: 4184,
                    watt_hour: 3600,
                    kilowatt_hour: 3.6e6,
                    electronvolt: 1.60218e-19,
                    btu: 1055.06
                }
            }
        };

        function populateUnits(category) {
            const unitOptions = category === 'temperature' 
                ? ['celsius', 'fahrenheit', 'kelvin']
                : Object.keys(units[category].factors);

            fromUnitSelect.innerHTML = '';
            toUnitSelect.innerHTML = '';

            unitOptions.forEach(unit => {
                const option1 = document.createElement('option');
                option1.value = unit;
                option1.textContent = unit.replace(/_/g, ' ').toUpperCase();
                fromUnitSelect.appendChild(option1);

                const option2 = document.createElement('option');
                option2.value = unit;
                option2.textContent = unit.replace(/_/g, ' ').toUpperCase();
                toUnitSelect.appendChild(option2);
            });

            // Set default to different units if possible
            if (unitOptions.length > 1) {
                toUnitSelect.value = unitOptions[1];
            }
        }

        function convert() {
            const category = categorySelect.value;
            const value = parseFloat(inputValue.value);
            if (isNaN(value)) {
                resultDiv.textContent = 'Please enter a valid number.';
                return;
            }

            const fromUnit = fromUnitSelect.value;
            const toUnit = toUnitSelect.value;

            if (fromUnit === toUnit) {
                resultDiv.textContent = `${value} ${fromUnit.replace(/_/g, ' ')} = ${value} ${toUnit.replace(/_/g, ' ')}`;
                return;
            }

            let result;
            if (category === 'temperature') {
                // Special conversions for temperature
                let celsius;
                if (fromUnit === 'celsius') celsius = value;
                else if (fromUnit === 'fahrenheit') celsius = (value - 32) * 5 / 9;
                else if (fromUnit === 'kelvin') celsius = value - 273.15;

                if (toUnit === 'celsius') result = celsius;
                else if (toUnit === 'fahrenheit') result = celsius * 9 / 5 + 32;
                else if (toUnit === 'kelvin') result = celsius + 273.15;

                result = result.toFixed(4);
            } else {
                // General conversion using factors
                const factors = units[category].factors;
                const baseValue = value * factors[fromUnit];
                result = (baseValue / factors[toUnit]).toFixed(4);
            }

            resultDiv.textContent = `${value} ${fromUnit.replace(/_/g, ' ')} = ${result} ${toUnit.replace(/_/g, ' ')}`;
        }

        categorySelect.addEventListener('change', () => populateUnits(categorySelect.value));
        convertBtn.addEventListener('click', convert);

        // Initial population
        populateUnits(categorySelect.value);
    });
</script>
@endsection
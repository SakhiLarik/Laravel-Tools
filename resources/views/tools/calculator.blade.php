@extends('layouts.app') <!-- Assuming you have a main layout -->

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Scientific Calculator</h1>
    
    <div id="calculator" class="max-w-sm mx-auto bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl shadow-2xl">
        <!-- Display -->
        <input type="text" id="display" class="w-full bg-gray-900 text-white text-4xl font-mono text-right p-4 mb-4 rounded-lg border border-gray-700 focus:outline-none" readonly>
        
        <!-- Buttons Grid -->
        <div class="grid grid-cols-5 gap-2">
            <!-- Row 1: Functions -->
            <button class="btn func" onclick="append('sin(')">sin</button>
            <button class="btn func" onclick="append('cos(')">cos</button>
            <button class="btn func" onclick="append('tan(')">tan</button>
            <button class="btn func" onclick="append('log(')">log</button>
            <button class="btn func" onclick="append('ln(')">ln</button>
            
            <!-- Row 2: More Functions -->
            <button class="btn func" onclick="append('asin(')">asin</button>
            <button class="btn func" onclick="append('acos(')">acos</button>
            <button class="btn func" onclick="append('atan(')">atan</button>
            <button class="btn func" onclick="append('sqrt(')">√</button>
            <button class="btn func" onclick="append('exp(')">exp</button>
            
            <!-- Row 3: Constants and Power -->
            <button class="btn func" onclick="append('Math.PI')">π</button>
            <button class="btn func" onclick="append('Math.E')">e</button>
            <button class="btn op" onclick="append('^')">^</button>
            <button class="btn op" onclick="append('%')">%</button>
            <button class="btn clear" onclick="clearDisplay()">C</button>
            
            <!-- Row 4: Numbers 7-9, /, ( -->
            <button class="btn num" onclick="append('7')">7</button>
            <button class="btn num" onclick="append('8')">8</button>
            <button class="btn num" onclick="append('9')">9</button>
            <button class="btn op" onclick="append('/')">/</button>
            <button class="btn op" onclick="append('(')">(</button>
            
            <!-- Row 5: Numbers 4-6, *, ) -->
            <button class="btn num" onclick="append('4')">4</button>
            <button class="btn num" onclick="append('5')">5</button>
            <button class="btn num" onclick="append('6')">6</button>
            <button class="btn op" onclick="append('*')">*</button>
            <button class="btn op" onclick="append(')')">)</button>
            
            <!-- Row 6: Numbers 1-3, -, +/- -->
            <button class="btn num" onclick="append('1')">1</button>
            <button class="btn num" onclick="append('2')">2</button>
            <button class="btn num" onclick="append('3')">3</button>
            <button class="btn op" onclick="append('-')">-</button>
            <button class="btn func" onclick="toggleSign()">+/-</button>
            
            <!-- Row 7: 0, ., +, =, 1/x -->
            <button class="btn num" onclick="append('0')">0</button>
            <button class="btn num" onclick="append('.')">.</button>
            <button class="btn op" onclick="append('+')">+</button>
            <button class="btn equal col-span-2" onclick="calculate()">=</button>
        </div>
    </div>
</div>

<script>
    const display = document.getElementById('display');

    function append(value) {
        display.value += value;
    }

    function clearDisplay() {
        display.value = '';
    }

    function toggleSign() {
        if (display.value) {
            if (display.value.startsWith('-')) {
                display.value = display.value.slice(1);
            } else {
                display.value = '-' + display.value;
            }
        }
    }

    function calculate() {
        let expr = display.value;
        
        // Replace functions with Math equivalents
        expr = expr.replace(/sin/g, 'Math.sin')
                   .replace(/cos/g, 'Math.cos')
                   .replace(/tan/g, 'Math.tan')
                   .replace(/asin/g, 'Math.asin')
                   .replace(/acos/g, 'Math.acos')
                   .replace(/atan/g, 'Math.atan')
                   .replace(/log/g, 'Math.log10')
                   .replace(/ln/g, 'Math.log')
                   .replace(/sqrt/g, 'Math.sqrt')
                   .replace(/exp/g, 'Math.exp')
                   .replace(/\^/g, '**');
        
        // Note: Assuming degrees for trig functions? If radians, no change. For degrees, need to convert.
        // For simplicity, using radians. To add deg/rad toggle, extend later.
        
        try {
            display.value = eval(expr);
        } catch (e) {
            display.value = 'Error';
        }
    }
</script>
@endsection
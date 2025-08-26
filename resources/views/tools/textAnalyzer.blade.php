@extends('layouts.app')  <!-- Assuming you have a standard Laravel layout -->

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Text Analyzer</h1>
            
            <div class="mb-6">
                <label for="input-text" class="block text-sm font-medium text-gray-700 mb-2">Enter your text here:</label>
                <textarea id="input-text" rows="10" class="w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-vertical"></textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Analysis Results</h2>
                    <div id="results" class="space-y-2">
                        <p><span class="font-medium">Character Count:</span> <span id="char-count">0</span></p>
                        <p><span class="font-medium">Word Count:</span> <span id="word-count">0</span></p>
                        <p><span class="font-medium">Sentence Count:</span> <span id="sentence-count">0</span></p>
                        <p><span class="font-medium">Average Word Length:</span> <span id="avg-word-length">0</span></p>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <!-- You can add more sections here if needed, like readability score -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('input-text');
        const charCount = document.getElementById('char-count');
        const wordCount = document.getElementById('word-count');
        const sentenceCount = document.getElementById('sentence-count');
        const avgWordLength = document.getElementById('avg-word-length');

        function updateAnalysis() {
            const text = textarea.value.trim();
            
            // Character count
            const chars = text.length;
            charCount.textContent = chars;
            
            if (chars === 0) {
                wordCount.textContent = 0;
                sentenceCount.textContent = 0;
                avgWordLength.textContent = 0;
                return;
            }
            
            // Word count
            const words = text.split(/\s+/).filter(word => word.length > 0);
            wordCount.textContent = words.length;
            
            // Sentence count
            const sentences = text.split(/[.!?]+/).filter(sentence => sentence.trim().length > 0);
            sentenceCount.textContent = sentences.length;
            
            // Average word length
            const totalWordLength = words.reduce((sum, word) => sum + word.length, 0);
            const avgLength = words.length > 0 ? (totalWordLength / words.length).toFixed(2) : 0;
            avgWordLength.textContent = avgLength;
        }

        textarea.addEventListener('input', updateAnalysis);
        updateAnalysis();  // Initial update
    });
</script>
@endsection
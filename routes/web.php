<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tools = [
        ['name' => 'Scientific Calculator', 'icon' => ' fa fab far fas fa-calculator', 'description' => 'An advanced scientific calculator for quick math.', 'url' => '/tools/calculator', 'component' => 'calculator'],
        ['name' => 'Text Analyzer', 'icon' => ' fa fab far fas fa-file', 'description' => 'Analyze text for word count and more.', 'url' => '/tools/text-analyzer', 'component' => 'textAnalyzer'],
        ['name' => 'Advanced Unit Converter', 'icon' => ' fa fab far fas fa-arrows-alt', 'description' => 'Advanced unit converter for all types of units.', 'url' => '/tools/unit-converter', 'component' => 'unitConverter'],
        ['name' => 'Currency Converter', 'icon' => ' fa fab far fas fa-money-bill-wave', 'description' => 'Convert currencies with real-time exchange rates.', 'url' => '/tools/currency-converter', 'component' => 'currencyConverter'],
        ['name' => 'QR Code Generator', 'icon' => ' fa fab far fas fa-qrcode', 'description' => 'Generate QR codes from text or URLs.', 'url' => '/tools/qr-code-generator', 'component' => 'qrCodeGenerator'],
        ['name' => 'AdSense Earnings Calculator', 'icon' => ' fa fab far fas fa-calculator', 'description' => 'Estimate your AdSense earnings based on various factors.', 'url' => '/tools/adsense-earning-calculator', 'component' => 'adsenseEarningCalculator'],
    ];

    return view('home', compact('tools'));
})->name('home');

Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/tools', [ToolController::class, 'index'])->name('tools');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/tools/calculator', [ToolController::class, 'calculator'])->name('tools.calculator');
Route::get('/tools/expense-calculator', [ToolController::class, 'expenseCalculator'])->name('tools.expense-calculator');
Route::get('/tools/text-analyzer', [ToolController::class, 'textAnalyzer'])->name('tools.text-analyzer');
Route::get('/tools/unit-converter', [ToolController::class, 'unitConverter'])->name('tools.unit-converter');
Route::get('/tools/currency-converter', [ToolController::class, 'currencyConverter'])->name('tools.currency-converter');
Route::get('/tools/qr-code-generator', [ToolController::class, 'qrCodeGenerator'])->name('tools.qr-code-generator');
Route::get('/tools/age-calculator', [ToolController::class, 'ageCalculator'])->name('tools.age-calculator');
Route::get('/tools/website-speed-checker', [ToolController::class, 'websiteSpeedChecker'])->name('tools.website-speed-checker');
Route::get('/tools/ip-address-finder', [ToolController::class, 'ipAddressFinder'])->name('tools.ip-address-finder');
Route::get('/tools/time-zone-converter', [ToolController::class, 'timeZoneConverter'])->name('tools.time-zone-converter');
Route::get('/tools/bmi-calculator', [ToolController::class, 'bmiCalculator'])->name('tools.bmi-calculator');
Route::get('/tools/adsense-earning-calculator', [ToolController::class, 'adsenseEarningCalculator'])->name('tools.adsense-earning-calculator');




// Assuming you have Route::get('/', ...) or similar, add:
Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');

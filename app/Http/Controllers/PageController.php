<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $tools = [
            ['name' => 'Scientific Calculator', 'icon' => ' fa fab far fas fa-calculator', 'description' => 'An advanced scientific calculator for quick math.', 'url' => '/tools/calculator', 'component' => 'calculator'],
            ['name' => 'Expense Calculator', 'icon' => ' fa fab far fas fa-calculator', 'description' => 'Calculate and manage your expenses effectively.', 'url' => '/tools/expense-calculator', 'component' => 'expenseCalculator'],
            ['name' => 'Text Analyzer', 'icon' => ' fa fab far fas fa-file', 'description' => 'Analyze text for word count and more.', 'url' => '/tools/text-analyzer', 'component' => 'textAnalyzer'],
            ['name' => 'Advanced Unit Converter', 'icon' => ' fa fab far fas fa-arrows-alt', 'description' => 'Advanced unit converter for all types of units.', 'url' => '/tools/unit-converter', 'component' => 'unitConverter'],
            ['name' => 'Currency Converter', 'icon' => ' fa fab far fas fa-money-bill-wave', 'description' => 'Convert currencies with real-time exchange rates.', 'url' => '/tools/currency-converter', 'component' => 'currencyConverter'],
            ['name' => 'QR Code Generator', 'icon' => ' fa fab far fas fa-qrcode', 'description' => 'Generate QR codes from text or URLs.', 'url' => '/tools/qr-code-generator', 'component' => 'qrCodeGenerator'],
            ['name' => 'Age Calculator', 'icon' => ' fa fab far fas fa-calendar-alt', 'description' => 'Calculate age based on birthdate.', 'url' => '/tools/age-calculator', 'component' => 'ageCalculator'],
            ['name' => 'Website Speed Checker', 'icon' => ' fa fab far fas fa-tachometer-alt', 'description' => 'Check the speed of your website.', 'url' => '/tools/website-speed-checker', 'component' => 'websiteSpeedChecker'],
            ['name' => 'IP Address Finder', 'icon' => ' fa fab far fas fa-network-wired', 'description' => 'Find details about an IP address.', 'url' => '/tools/ip-address-finder', 'component' => 'ipAddressFinder'],
            ['name' => 'Time Zone Converter', 'icon' => ' fa fab far fas fa-clock', 'description' => 'Convert time between different time zones.', 'url' => '/tools/time-zone-converter', 'component' => 'timeZoneConverter'],
            ['name' => 'BMI Calculator', 'icon' => ' fa fab far fas fa-calculator', 'description' => 'Calculate Body Mass Index (BMI) based on weight and height.', 'url' => '/tools/bmi-calculator', 'component' => 'bmiCalculator'],
            ['name' => 'AdSense Earnings Calculator', 'icon' => ' fa fab far fas fa-calculator', 'description' => 'Estimate your AdSense earnings based on various factors.', 'url' => '/tools/adsense-earning-calculator', 'component' => 'adsenseEarningCalculator'],
        ];

        return view('home', compact('tools'));
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }
}

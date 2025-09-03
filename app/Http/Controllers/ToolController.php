<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = [
            ['name' => 'Scientific Calculator', 'description' => 'An advanced scientific calculator for quick math.', 'url' => '/tools/calculator', 'component' => 'calculator'],
            ['name' => 'Expense Calculator', 'description' => 'Calculate and manage your expenses effectively.', 'url' => '/tools/expense-calculator', 'component' => 'expenseCalculator'],
            ['name' => 'Text Analyzer', 'description' => 'Analyze text for word count and more.', 'url' => '/tools/text-analyzer', 'component' => 'textAnalyzer'],
            ['name' => 'Advanced Unit Converter', 'description' => 'Advanced unit converter for all types of units.', 'url' => '/tools/unit-converter', 'component' => 'unitConverter'],
            ['name' => 'Currency Converter', 'description' => 'Convert currencies with real-time exchange rates.', 'url' => '/tools/currency-converter', 'component' => 'currencyConverter'],
            ['name' => 'QR Code Generator', 'description' => 'Generate QR codes from text or URLs.', 'url' => '/tools/qr-code-generator', 'component' => 'qrCodeGenerator'],
            ['name' => 'Age Calculator', 'description' => 'Calculate age based on birthdate.', 'url' => '/tools/age-calculator', 'component' => 'ageCalculator'],
            ['name' => 'Website Speed Checker', 'description' => 'Check the speed of your website.', 'url' => '/tools/website-speed-checker', 'component' => 'websiteSpeedChecker'],
            ['name' => 'IP Address Finder', 'description' => 'Find details about an IP address.', 'url' => '/tools/ip-address-finder', 'component' => 'ipAddressFinder'],
            ['name' => 'Time Zone Converter', 'description' => 'Convert time between different time zones.', 'url' => '/tools/time-zone-converter', 'component' => 'timeZoneConverter'],
        ];

        return view('tools', compact('tools'));
    }
    public function calculator(){
        return view("tools.calculator");
    }

    public function expenseCalculator(){
        return view("tools.expenseCalculator");
    }   

    public function textAnalyzer(){
        return view("tools.textAnalyzer");
    }

    public function unitConverter(){
        return view("tools.unitConverter");
    }

    public function currencyConverter(){
        return view("tools.currencyConverter");
    }

    public function qrCodeGenerator(){
        return view("tools.qrCodeGenerator");
    }

    public function ageCalculator(){
        return view("tools.ageCalculator");
    }

    public function websiteSpeedChecker(){
        return view("tools.websiteSpeedChecker");
    }

    public function ipAddressFinder(){
        return view("tools.ipAddressFinder");
    }

    public function timeZoneConverter(){
        return view("tools.timeZoneConverter");
    }
}
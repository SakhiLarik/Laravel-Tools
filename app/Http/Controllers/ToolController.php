<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = [
            ['name' => 'Scientific Calculator', 'description' => 'An advanced scientific calculator for quick math.', 'url' => '/tools/calculator', 'component' => 'calculator'],
            ['name' => 'Text Analyzer', 'description' => 'Analyze text for word count and more.', 'url' => '/tools/text-analyzer', 'component' => 'textAnalyzer'],
            ['name' => 'Advanced Unit Converter', 'description' => 'Advanced unit converter for all types of units.', 'url' => '/tools/unit-converter', 'component' => 'unitConverter'],
            ['name' => 'Currency Converter', 'description' => 'Convert currencies with real-time exchange rates.', 'url' => '/tools/currency-converter', 'component' => 'currencyConverter'],
        ];

        return view('tools', compact('tools'));
    }
    public function calculator(){
        return view("tools.calculator");
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
}
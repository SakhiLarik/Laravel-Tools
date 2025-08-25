<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = [
            ['name' => 'Scientific Calculator', 'description' => 'An advanced scientific calculator for quick math.', 'url' => '/tools/calculator', 'component' => 'calculator'],
            ['name' => 'Text Analyzer', 'description' => 'Analyze text for word count and more.', 'url' => '#'],
            ['name' => 'Unit Converter', 'description' => 'Convert units like length, weight, etc.', 'url' => '#'],
        ];

        return view('tools', compact('tools'));
    }
    public function calculator(){
        return view("tools.calculator");
    }
}
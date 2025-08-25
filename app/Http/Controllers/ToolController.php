<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = [
            ['name' => 'Calculator', 'description' => 'A simple calculator for quick math.', 'url' => '#'],
            ['name' => 'Text Analyzer', 'description' => 'Analyze text for word count and more.', 'url' => '#'],
            ['name' => 'Unit Converter', 'description' => 'Convert units like length, weight, etc.', 'url' => '#'],
        ];

        return view('tools', compact('tools'));
    }
}
<?php
// app/Http/Controllers/FileUploadController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
       $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
        ]);

        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        // Uploads the file into the storage folder storage/app/uploads/public
        $storage_path = $request->file('file')->store('uploads', 'public');
        // Uploads the file into the public folder public/uploads
        $public_path = $request->file('file')->move(public_path('uploads'), $fileName);

        return response()->json([
            'url' => '/uploads/' . $fileName,
        ]);
    }
}
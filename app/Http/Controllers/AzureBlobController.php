<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AzureBlobController extends Controller
{
    public function index()
    {
        $files = Storage::disk('azure')->files();
        return view('azure.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240'
        ]);

        $path = Storage::disk('azure')->putFile('', $request->file('file'));  // يمكن وضع اسم فولدر بدل ''
        return redirect()->route('azure.index')->with('success', 'File uploaded successfully!');
    }

    public function download($file)
    {
        return Storage::disk('azure')->download($file);
    }

    public function delete($file)
    {
        Storage::disk('azure')->delete($file);
        return redirect()->route('azure.index')->with('success', 'File deleted successfully!');
    }
}

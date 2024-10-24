<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class S3CheckController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $path = $request->file('file')->store('photo_profile', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        $url = Storage::disk('s3')->url($path);
        $user->update(['image' => $url]);
        return back()->with('success', 'File berhasil diupload: ' . $url);
    }

}

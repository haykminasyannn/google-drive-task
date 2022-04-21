<?php

namespace App\Http\Controllers;

use App\Jobs\SaveGoogleDriveFiles;

class GoogleDriveController extends Controller
{
    public function index()
    {
        return view('google-drive.home');
    }

    public function saveGoogleDriveFiles()
    {
        SaveGoogleDriveFiles::dispatch();
        return back()->with('process', 'on');
    }
}

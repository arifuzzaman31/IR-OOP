<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function settings()
    {
        return view('pages.settings.settings', ['page_title' => "Settings"]);
    }
}

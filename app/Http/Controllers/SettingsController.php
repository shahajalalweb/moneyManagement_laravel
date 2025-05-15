<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settingsData = Settings::first();
        return view('setting', ['settingsData' => $settingsData]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'footer' => 'required',
        ]);
        // Check if settings already exist
        $existingSettings = Settings::first();
        if ($existingSettings) {
            // Update existing settings
            $existingSettings->title = $request->input('title');
            $existingSettings->footer = $request->input('footer');
            $existingSettings->save();
            return redirect()->back()->with('success', 'Settings updated successfully.');
        } else {
            // Settings do not exist, create new settings
            $settings = new Settings();
            $settings->title = $request->input('title');
            $settings->footer = $request->input('footer');
            $settings->save();
            return redirect()->back()->with('success', 'Settings created successfully.');
        }
    }
}

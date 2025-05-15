<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Account extends Controller
{
    public function account()
    {
        return view('account');
    }

    public function changePassword()
    {
        return view('change');
    }

    public function editProfile()
    {
        return view('change');
    }

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->load('profile');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user
        $user->update([
            'name' => $validatedData['name'],
        ]);

        // Handle profile data
        $profileData = [
            'phone' => $validatedData['phone'] ?? null,
            'address' => $validatedData['address'] ?? null,
            'bio' => $validatedData['bio'] ?? null,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Ensure directory exists
            if (!Storage::exists('profile_pictures')) {
                Storage::makeDirectory('profile_pictures');
            }

            // Store image and get path
            $profileData['profile_picture'] = $request->file('profile_picture')
                ->store('profile_pictures');

            if ($user->profile?->profile_picture && Storage::fileExists($user->profile?->profile_picture)) {
                // Delete old profile picture if it exists
                Storage::delete($user->profile?->profile_picture);
            }
        }

        // Update or create profile
        $user->profile()->updateOrCreate([], $profileData);

        return redirect()->route('account')->with('success', 'Profile updated successfully.');
    }
}

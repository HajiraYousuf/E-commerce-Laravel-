<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    

    public function index()
    {
        $user = Auth::user();

        $settings = Settings::where('user_id', $user->id)
            ->pluck('value', 'key')
            ->toArray(); // muhiim si Blade sahlan u noqoto

        return view('admin.settings.settings', compact('user', 'settings'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'nullable|string',
            'email' => 'required|email',
            'phone' => 'nullable',
            'country' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'postal_code' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        // IMAGE
        if ($request->hasFile('image')) {

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $data['image'] = $request->file('image')
                ->store('profiles', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully');
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        // haddii settings aysan jirin error ha dhicin
        if (!$request->has('settings')) {
            return back();
        }

        foreach ($request->settings as $key => $value) {

            Settings::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'key' => $key
                ],
                [
                    'value' => $value
                ]
            );
        }

        
        return back()->with('success', 'Settings updated');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => [
                'required',
                'confirmed',
                'min:8'
            ],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {

            throw ValidationException::withMessages([
                'current_password' => 'Current password is incorrect',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully');
    }
    public function updateNotifications(Request $request)
{
    $user = auth()->user();

    foreach ($request->settings as $section => $items) {

        foreach ($items as $key => $value) {

            Settings::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'key' => "notifications.$section.$key"
                ],
                [
                    'value' => $value ? 1 : 0
                ]
            );
        }
    }

    return back()->with('success', 'Notifications updated successfully');
}
}
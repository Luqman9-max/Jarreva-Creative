<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'profile_photo' => 'nullable|image|max:2048',
            'current_password' => 'nullable|required_with:new_password|current_password:admin',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Handle Profile Photo
        if ($request->hasFile('profile_photo')) {
            if ($admin->profile_photo_path) {
                Storage::disk('public')->delete($admin->profile_photo_path);
            }
            $data['profile_photo_path'] = $request->file('profile_photo')->store('admin-photos', 'public');
        }

        // Handle Password Update
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        /** @var \App\Models\Admin $admin */
        $admin->update($data);

        return back()->with('success', 'Settings updated successfully!');
    }
}

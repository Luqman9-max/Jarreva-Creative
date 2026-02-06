<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = \App\Models\Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        ]);

        \App\Helpers\ActivityLogger::log('created', "Created new admin: {$admin->name}", $admin);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully!');
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $admin->update($data);

        \App\Helpers\ActivityLogger::log('updated', "Updated profile for admin: {$admin->name}", $admin);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully!');
    }

    public function destroy(\App\Models\Admin $admin)
    {
        if ($admin->id === \Illuminate\Support\Facades\Auth::guard('admin')->id()) {
            return back()->with('error', 'You cannot delete yourself!');
        }

        if ($admin->profile_photo_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($admin->profile_photo_path);
        }

        $name = $admin->name;
        $admin->delete();

        \App\Helpers\ActivityLogger::log('deleted', "Deleted admin: {$name}", null);

        return redirect()->route('admin.admins.index')->with('delete', 'Admin deleted successfully!');
    }
}

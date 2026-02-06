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

    public function store(\App\Http\Requests\Admin\AdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo_path'] = $request->file('profile_photo')->store('admin-photos', 'public');
        }

        Admin::create($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully!');
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(\App\Http\Requests\Admin\AdminRequest $request, Admin $admin)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        } else {
            unset($data['password']); // Keep existing password
        }

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($admin->profile_photo_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($admin->profile_photo_path);
            }
            $data['profile_photo_path'] = $request->file('profile_photo')->store('admin-photos', 'public');
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully!');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->id === auth()->guard('admin')->id()) {
            return back()->with('error', 'You cannot delete yourself!');
        }

        if ($admin->profile_photo_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($admin->profile_photo_path);
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully!');
    }
}

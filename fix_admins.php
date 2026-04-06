<?php
use App\Models\Admin;

$admins = Admin::all();
foreach ($admins as $admin) {
    if ($admin->password === 'ABOGOBOGA' || !str_starts_with($admin->password, '$2y$')) {
        // Use the name as a temporary password if it's currently broken
        $admin->password = strtolower($admin->name); 
        $admin->save();
        echo "Fixed password for admin: {$admin->email} (set to lowercased name)\n";
    } else {
        echo "Skipping admin: {$admin->email} (already hashed)\n";
    }
}

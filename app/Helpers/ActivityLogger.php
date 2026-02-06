<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($action, $description, $subject = null)
    {
        if (Auth::guard('admin')->check()) {
            ActivityLog::create([
                'admin_id' => Auth::guard('admin')->id(),
                'action' => $action,
                'description' => $description,
                'subject_type' => $subject ? get_class($subject) : null,
                'subject_id' => $subject ? $subject->id : null,
            ]);
        }
    }
}

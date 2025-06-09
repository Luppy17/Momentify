<?php

namespace App\Services;

use App\Models\UserLog;

class UserLogService
{
    public static function log($action, $status = 'success', $details = null)
    {
        return UserLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'ip_address' => request()->ip(),
            'status' => $status,
            'details' => $details
        ]);
    }
}
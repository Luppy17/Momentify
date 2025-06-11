<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin) {
            $totalAssignedEvents = 0;
            if (auth()->user()->is_photographer) {
                $totalAssignedEvents = Event::whereHas('photographers', function ($query) {
                    $query->where('email', auth()->user()->email);
                })->count();
            }
            $data = [
                'totalEvents' => Event::count(),
                'totalAssigned' => $totalAssignedEvents,
            ];

            return view('dashboard', $data);
        }

        $data = [
            'totalUsers' => User::count(),
            'totalEvents' => Event::count(),
            'activePhotographers' => User::where('is_photographer', 1)->where('status', 'active')->count(),
            'totalPhotos' => EventImage::count(),
            'activityData' => collect([]),
            'userLogs' => collect([])
        ];

        if (Schema::hasTable('user_logs')) {
            $data['activityData'] = UserLog::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $data['userLogs'] = UserLog::with('user')
                ->latest()
                ->paginate(10);

            $data['allUserLogs'] = UserLog::with('user')
                ->latest()
                ->paginate(15);
        }

        return view('roles.admin.dashboard', $data);
    }

    public function getStats()
    {
        return response()->json([
            'totalUsers' => User::count(),
            'totalEvents' => Event::count(),
            'activePhotographers' => User::where('is_photographer', 1)->count(),
            'totalPhotos' => EventImage::count()
        ]);
    }

    public function getLogs()
    {
        $logs = UserLog::with('user')
            ->latest()
            ->paginate(10);

        return response()->json($logs);
    }

    public function getActivity()
    {
        $activity = UserLog::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($activity);
    }

    public function filterLogs(Request $request)
    {
        $query = UserLog::with('user')->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhere('action', 'like', "%{$search}%")
            ->orWhere('details', 'like', "%{$search}%");
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->paginate(15));
    }
}

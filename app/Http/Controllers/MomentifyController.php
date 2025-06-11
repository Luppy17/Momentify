<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MomentifyController extends Controller
{
    /**
     * Display the momentify index page with search functionality
     */
    public function index(Request $request)
    {
        // Get the search query if provided
        $search = $request->input('search');

        // Get events with photographers
        $events = Event::with('photographers')
            ->when($search, function ($query) use ($search) {
                return $query->where('event_name', 'like', '%' . $search . '%')
                            ->orWhere('event_place', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('momentify.index', compact('search', 'events'));
    }

    /**
     * Display the welcome page with events
     */
    public function welcome()
    {
        // Get events with photographers for the welcome page
        $events = Event::with('photographers')
            ->latest()
            ->get();

        return view('welcome', compact('events'));
    }
}

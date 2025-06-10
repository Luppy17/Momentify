<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivated;
use Illuminate\Support\Facades\Hash;

class EventManagerRoleManagementController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('search');
        $managers = User::where('is_event_manager', 1)->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%')
                                ->orWhere('email', 'like', '%' . $query . '%');
        })->get();

        return view('roles.event-manager.index', compact('managers'));
    }

    public function create(Request $request) {
        return view('roles.event-manager.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_event_manager' => 1,
            'status' => 'active',
        ]);

        return redirect()->route('role.management.event.manager.index')->with('success', 'Event Manager created successfully!');
    }

    public function destroy($id)
    {
        $manager = User::find($id);
        $manager->update(['status' => $manager->status === 'active' ? 'inactive' : 'active']);

        $message = $manager->status === 'active' ? 'activated' : 'deactivated';

        if ($manager->status === 'active') {
            // Send email notification
            Mail::to($manager->email)->send(new AccountActivated($manager));
        }

        return redirect()->route('role.management.event.manager.index')->with('success', "Event Manager {$message} successfully!");
    }
}

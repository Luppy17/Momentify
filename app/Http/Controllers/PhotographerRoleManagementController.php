<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photographer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivated;
use Illuminate\Support\Facades\Hash;

class PhotographerRoleManagementController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('search');
        $photographers = User::where('is_photographer', 1)->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%')
                                ->orWhere('email', 'like', '%' . $query . '%');
        })->get();

        return view('roles.photographer.index', compact('photographers'));
    }

    public function create(Request $request) {
        return view('roles.photographer.create');
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
            'is_photographer' => 1,
            'status' => 'active',
        ]);

        Photographer::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('role.management.photographer.index')->with('success', 'Photographer created successfully!');
    }

    public function destroy($id)
    {
        $photographer = User::find($id);
        $photographer->update(['status' => $photographer->status === 'active' ? 'inactive' : 'active']);

        $message = $photographer->status === 'active' ? 'activated' : 'deactivated';

        if ($photographer->status === 'active') {
            // Send email notification
            Mail::to($photographer->email)->send(new AccountActivated($photographer));
        }
        
        return redirect()->route('role.management.photographer.index')->with('success', "Photographer {$message} successfully!");
    }
}

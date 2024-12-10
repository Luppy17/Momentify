<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class NormalUserRoleManagementController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('search');
        $users = User::where('is_user', 1)->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%')
                                ->orWhere('email', 'like', '%' . $query . '%');
        })->get();

        return view('roles.user.index', compact('users'));
    }

    public function create(Request $request) {
        return view('roles.user.create');
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
            'is_user' => 1
        ]);

        return redirect()->route('role.management.normal.user.index')->with('success', 'User created successfully!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('role.management.normal.user.index')->with('success', 'User deleted successfully!');
    }
}

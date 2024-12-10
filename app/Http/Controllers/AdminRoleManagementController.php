<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminRoleManagementController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('search');
        $admins = User::where('is_admin', 1)->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%')
                                ->orWhere('email', 'like', '%' . $query . '%');
        })->get();

        return view('roles.admin.index', compact('admins'));
    }

    public function create(Request $request) {
        return view('roles.admin.create');
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
            'is_admin' => 1
        ]);

        return redirect()->route('role.management.admin.index')->with('success', 'Admin created successfully!');
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        $admin->delete();

        return redirect()->route('role.management.admin.index')->with('success', 'Admin deleted successfully!');
    }
}

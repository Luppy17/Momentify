<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\NewUserRegisteredNotification;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', \Illuminate\Validation\Rule::in(['event_manager', 'photographer'])],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_event_manager' => $request->role == 'event_manager',
            'is_photographer' => $request->role == 'photographer',
            'status' => 'inactive',
        ]);

        event(new Registered($user));

        // Determine management link
        $managementLink = null;
        if ($user->is_event_manager) {
            $managementLink = route('role.management.event.manager.index');
        } elseif ($user->is_photographer) {
            $managementLink = route('role.management.photographer.index');
        }

        // Notify admins
        Mail::to(env('MAIL_USERNAME'))->send(new NewUserRegisteredNotification($user, $managementLink));

        return redirect(route('welcome', absolute: false));

        // Auth::login($user);
        // return redirect(route('dashboard', absolute: false));
    }
}

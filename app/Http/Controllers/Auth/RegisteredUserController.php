<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Alert;

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
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phonenumber' => ['required', 'string', 'max:20'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg'],
        ]);

        // dd($request->valodate());
        // jika avatar di input
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'phonenumber' => $request->phonenumber,
            'avatar' => $avatarPath,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // dd($user);
        $user->assignRole('customer');

        event(new Registered($user));

        Auth::login($user);
        alert()->success('Success', 'Registered successfully.');
        return redirect(route('home', absolute: false));
    }
}

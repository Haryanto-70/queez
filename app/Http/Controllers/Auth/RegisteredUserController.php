<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function adduser(Request $request)   //: RedirectResponse
    {
        //       dd($request['id'], $request['userName'], $request['userEmail'], Auth::user());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,

        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make('quenet123'),
        ]);

        return Redirect::route('setting');
    }

    public function edituser(Request $request): RedirectResponse
    {
        //       dd($request['id'], $request['userName'], $request['userEmail'], Auth::user());
        $name = $request['name'];
        $email = $request['email'];
        $status = $request['status'];
        $role = $request['role'];
        $company = Auth::User()->company;

        //  dd($name, $role, $email, $status);



        $role = DB::table('roles')
            ->where('role', $role)
            ->select('id')
            ->first();

        DB::table('users')
            ->where('email', $email)
            ->update([
                'name' => $name,
                'active' => $status,
                'role' => $role->id,
            ]);

        //dd($name, $role, $email, $status);

        return Redirect::route('dashboard');
    }
}

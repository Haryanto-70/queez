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
        $newRole = $request['id'];

        //dd($name, $role, $email, $status);

        if ($newRole == 'nonewrole') {


            $role = $role;
        } else {
            $role = $newRole;
        };


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

    public function roleslist(Request $request)
    {
        //       dd($request['id'], $request['userName'], $request['userEmail'], Auth::user());
        $name = $request['name'];
        $email = $request['email'];
        $status = $request['status'];
        $role = Auth::user()->role;
        $company = Auth::User()->company;


        //  dd($name, $role, $email, $status);
        if ($role == '6ce8bcba-7030-360a-7c19-8709c47179e6') {
            $data = DB::table('roles')
                ->select('role', 'description')
                ->get();
        } elseif ($role == '7bfd0b8f-46e5-8e6b-1522-f7ddc2a589de') {
            $data = DB::table('roles')
                ->where('category', '<', 2)
                ->select('role', 'description')
                ->get();
        } elseif ($role == 'c63b8d84-9d6c-8298-43d6-fe67c96e0059') {
            $data = DB::table('roles')
                ->where('category', '<', 6)
                ->select('role', 'description')
                ->get();
        } else {
            $data = DB::table('roles')
                ->where('category', '=', 0)
                ->select('role', 'description')
                ->get();
        }



        return response()->json($data);
    }
}

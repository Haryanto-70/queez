<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function users(Request $request)
    {
        $data = DB::table('users')
            ->get();

        return response()->json($data);
    }

    public function addusers(Request $request)
    {
        $userName = request('user.userName');
        dd($userName);
        $data = DB::table('users')
            ->get();

        return response()->json($data);
    }

    public function userList(Request $request)
    {
        $uemail = Auth::user()->email;
        $company = Auth::user()->company;
        $accesslevel = Auth::user()->role;

        if ($company == 'alkemi' && $accesslevel == '6ce8bcba-7030-360a-7c19-8709c47179e6') {
            $data = DB::table('users')
                ->join('roles', 'roles.id', 'users.role')
                ->select('users.name', 'users.email', 'users.company', 'users.active', 'roles.role',  'roles.description')
                ->orderBy('users.active')
                ->orderBy('users.company')
                ->orderBy('roles.category')
                ->orderBy('users.name')
                ->get();
        } elseif ($accesslevel == 'c63b8d84-9d6c-8298-43d6-fe67c96e0059') {
            $data = DB::table('users')
                ->where('company', '=', $company)
                ->join('roles', 'roles.id', 'users.role')
                ->select('users.name', 'users.email', 'users.company', 'users.active', 'roles.role',  'roles.description')
                ->orderBy('users.active')
                ->orderBy('users.company')
                ->orderBy('roles.category')
                ->orderBy('users.name')
                ->get();
        } elseif ($accesslevel == '7bfd0b8f-46e5-8e6b-1522-f7ddc2a589de') {
            $data = DB::table('users')
                ->where('company', '=', $company)
                ->whereNotIn('role', ['c63b8d84-9d6c-8298-43d6-fe67c96e0059', 'c9e11b93-7cee-3c3f-175e-ac6476ca34e0', 'a99e3b4d-54fd-6e51-5a2f-4ed7f06f6582', 'c4c472fe-4a3e-8d7c-326d-2779c0170f38'])
                ->join('roles', 'roles.id', 'users.role')
                ->select('users.name', 'users.email', 'users.company', 'users.active', 'roles.role',  'roles.description')

                ->orderBy('users.active')
                ->orderBy('users.company')
                ->orderBy('roles.category')
                ->orderBy('users.name')
                ->get();
        } else {
            $data = DB::table('users')
                ->where('company', '=', $company)
                ->where('email', '=', $uemail)
                ->join('roles', 'roles.id', 'users.role')
                ->select('users.name', 'users.email', 'users.company', 'users.active', 'roles.role',  'roles.description')
                ->orderBy('users.active')
                ->orderBy('users.company')
                ->orderBy('roles.category')
                ->orderBy('users.name')
                ->get();
        }

        return response()->json($data);
    }
}

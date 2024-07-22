<?php

namespace App\Http\Controllers;



use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class DeskController extends Controller
{
    //
    public function desk(Request $request): Response
    {
        $dNo = request('dNo');
        $user = Auth::user()->name;
        $email = Auth::user()->email;
        $uid = Auth::user()->id;


        $data = DB::table('desk')
            ->where('user_id', '=', $uid)
            ->where('status', '=', 'inservice')
            ->get();



        if ($data->count() == 0) {
            db::table('desk')
                ->insert([
                    'user_id' => $uid,
                    'desk_no' => $dNo,
                    'status' => 'inservice',
                    'created_at' => now()
                ]);
        } else {
        }
        return Inertia::render('ServiceDesk/DeskCounter');
    }

    public function userdesk(Request $request)
    {
        $uid = Auth::user()->id;
        $data = DB::table('desk')
            ->where('user_id', $uid)
            ->join('users', 'users.id', 'desk.user_id')
            ->select('desk.desk_no', 'desk.status', 'users.name', 'users.id', 'users.role')

            ->get();

        return response()->json($data);
    }
}

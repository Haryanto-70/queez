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
            ->select('desk.desk_no', 'desk.status', 'desk.queue_no', 'users.name', 'users.id', 'users.role')
            ->get();

        return response()->json($data);
    }

    public function queuelist(Request $request)
    {
        $uid = Auth::user()->id;
        $type = request('type');
        // dd($type);

        if ($type == 'all') {
            $data = DB::table('queue')
                ->whereIn('status', ['new', 'pending'])
                ->where('in_counter', 0)
                ->orderBy('service_type')
                ->orderBy('created_at')
                ->select('*')
                ->limit(20)
                ->get();
        } else {
            $data = DB::table('queue')
                ->whereIn('status', ['new', 'pending'])
                ->where('service_type', $type)
                ->where('in_counter', 0)
                ->orderBy('service_type')
                ->orderBy('created_at')
                ->select('*')
                ->limit(20)
                ->get();
        }


        return response()->json($data);
    }

    public function selectqueue(Request $request)
    {
        $uid = Auth::user()->id;
        $qUuid = $request['quuid'];
        //  dd($qUuid);
        $data = DB::table('queue')
            ->where('quuid', $qUuid)
            ->select('queue_no')
            ->get();

        // dd(($data[0]->queue_no));

        DB::table('queue')
            ->where('quuid', $qUuid)
            ->update(['user_id' => $uid]);

        DB::table('desk')
            ->where('user_id', $uid)
            ->where('status', 'inservice')
            ->update(['queue_no' => $data[0]->queue_no]);


        //  return response()->json(['status' => 'ok']);
    }

    public function callqueue(Request $request)
    {
        $uid = Auth::user()->id;
        $qNo = $request['qNo'];
        $data = DB::table('desk')
            ->where('user_id', $uid)
            ->where('status', 'inservice')
            ->select('desk_no')
            ->get();

        // dd($uid);
        DB::table('queue')
            ->where('queue_no', $qNo)
            ->whereIn('status', ['new', 'pending'])
            ->update([
                'status' => 'call',
                'in_counter' => $data[0]->desk_no
            ]);



        //  return response()->json(['status' => 'ok']);
    }
}

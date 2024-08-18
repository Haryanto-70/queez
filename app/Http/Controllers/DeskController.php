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

        $role = Auth::user()->role;
        if ($role == 'c9e11b93-7cee-3c3f-175e-ac6476ca34e0' || $role == 'a99e3b4d-54fd-6e51-5a2f-4ed7f06f6582' || $role == 'c4c472fe-4a3e-8d7c-326d-2779c0170f38') {
            return Inertia::render('Error/401');
        }
        return Inertia::render('ServiceDesk/DeskCounter');
    }

    public function userdesk(Request $request)
    {
        $uid = Auth::user()->id;
        $company = Auth::user()->company;

        $statusQueue = DB::table('queue')
            ->where('company', $company)
            ->where('user_id', $uid)
            ->whereNotIn('status', ['finished', 'canceled'])
            ->get();

        if ($statusQueue->count() >= 1) {
            foreach ($statusQueue as $statusQ) {

                $statusQNo = $statusQ->queue_no;
                $syncDesk = DB::table('desk')
                    ->where('queue_no', $statusQNo)
                    ->get();
                if ($syncDesk->count() == 0) {
                    DB::table('desk')
                        ->where('user_id', $uid)
                        ->update([
                            'queue_no' => $statusQNo,
                            'updated_at' => now(),
                        ]);
                }
            }
        }

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
        $company = Auth::user()->company;
        // dd($type);

        if ($type == 'all') {
            $data = DB::table('queue')
                ->where('company', $company)
                ->whereIn('status', ['new', 'pending'])
                ->where('in_counter', 0)
                ->orderBy('service_type')
                ->orderBy('created_at')
                ->select('*')
                ->limit(20)
                ->get();
        } else {
            $data = DB::table('queue')
                ->where('company', $company)
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
        $company = Auth::user()->company;
        //  dd($qUuid);
        $data = DB::table('queue')
            ->where('company', $company)
            ->where('quuid', $qUuid)
            ->select('queue_no')
            ->get();

        // dd(($data[0]->queue_no));

        DB::table('queue')
            ->where('company', $company)
            ->where('quuid', $qUuid)
            ->update(['user_id' => $uid]);

        DB::table('desk')
            ->where('user_id', $uid)
            ->where('status', 'inservice')
            ->update([
                'queue_no' => $data[0]->queue_no,
                'updated_at' => now(),
            ]);


        //  return response()->json(['status' => 'ok']);
    }

    public function callqueue(Request $request)
    {
        $uid = Auth::user()->id;
        $qNo = $request['qNo'];
        $company = Auth::user()->company;
        $data = DB::table('desk')
            ->where('user_id', $uid)
            ->where('status', 'inservice')
            ->select('desk_no')
            ->get();

        // dd($uid);
        DB::table('queue')
            ->where('company', $company)
            ->where('queue_no', $qNo)
            ->whereIn('status', ['new', 'pending'])
            ->update([
                'status' => 'call',
                'in_counter' => $data[0]->desk_no,
                'updated_at' => now(),
            ]);

        //  return response()->json(['status' => 'ok']);
    }
    public function startqueue(Request $request)
    {
        $uid = Auth::user()->id;
        $qNo = $request['qNo'];
        $company = Auth::user()->company;

        $data = DB::table('queue')
            ->where('company', $company)
            ->where('queue_no', $qNo)
            ->where('user_id', $uid)
            ->where('status', 'called')
            ->count();

        // dd($uid);
        DB::table('queue')
            ->where('company', $company)
            ->where('queue_no', $qNo)
            ->where('user_id', $uid)
            ->where('status', 'called')
            ->whereIn('status', ['called', 'pending'])
            ->update([
                'status' => 'started',
                'started_at' => now(),
                'updated_at' => now(),
            ]);

        return response()->json($data);
    }
    public function finishedqueue(Request $request)
    {
        $uid = Auth::user()->id;
        $qNo = $request['qNo'];
        $company = Auth::user()->company;

        // dd($uid);
        DB::table('queue')
            ->where('company', $company)
            ->where('queue_no', $qNo)
            ->where('user_id', $uid)
            ->whereIn('status', ['started', 'pending'])
            ->update([
                'status' => 'finished',
                'in_counter' => 0,
                'finished_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('desk')
            ->where('user_id', $uid)
            ->where('queue_no', $qNo)
            ->update([
                'queue_no' => '----',
                'updated_at' => now(),
            ]);
        //  convert to second in duration

        $timeDiff = DB::table('queue')
            ->where('company', $company)
            ->where('queue_no', $qNo)
            ->where('user_id', $uid)
            ->where('status', 'finished')
            ->select('started_at', 'finished_at')
            ->get();

        //   $duration = now() - $startTime;
        $epochStart = strtotime($timeDiff[0]->started_at);
        $epochFinish = strtotime($timeDiff[0]->finished_at);
        $diffTime = $epochFinish - $epochStart;

        DB::table('queue')
            ->where('company', $company)
            ->where('queue_no', $qNo)
            ->where('user_id', $uid)
            ->where('status', 'finished')
            ->update([
                'duration' => $diffTime,
            ]);


        //  return response()->json(['status' => 'ok']);
    }

    public function exitdesk(Request $request): RedirectResponse
    {

        $uid = Auth::user()->id;
        // dd('exit desk', $uid);
        DB::table('desk')
            ->where('user_id', $uid)
            ->delete();



        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function quecancel(Request $request)
    {

        $uid = Auth::user()->id;
        $qNo = $request['qNo'];
        $company = $request['company'];
        // dd('exit desk', $uid);
        DB::table('queue')
            ->where('company', $company)
            ->where('user_id', $uid)
            ->where('queue_no', $qNo)
            ->update([
                'status' => 'new',
                'in_counter' => 0,
                'user_id' => null
            ]);
    }
}

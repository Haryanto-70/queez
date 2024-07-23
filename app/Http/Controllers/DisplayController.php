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




class DisplayController extends Controller
{
    //
    public function display(): Response
    {

        return Inertia::render('Display/Display');
    }

    public function dispenser(): Response
    {

        return Inertia::render('Ticket/Dispenser');
    }

    public function queue(Request $request)
    {

        $sId = $request['sId'];
        // dd('test point', $sId);
        $data = DB::table('queue')
            ->where('service_type', '=', $sId)
            ->where('status', '<>', 'finished')
            ->get();

        $count = $data->count() + 1;
        if ($count < 10) {
            $queueId = $sId . "" . "000";
        } else if ($count < 100) {
            $queueId = $sId . "" . "00";
        } else if ($count < 1000) {
            $queueId = $sId . "" . "0";
        } else {
            $queueId = $sId . "" . "";
        }

        $queueNo = $queueId . "" . "$count";
        //dd($queueNo, $sId, $count);
        DB::table('queue')
            ->insert([
                'service_type' => $sId,
                'queue_id' => $count,
                'queue_no' => $queueNo,
                'status' => 'new',
                'created_at' => now(),
            ]);

        $data = DB::table('queue')
            ->where('service_type', '=', $sId)
            ->where('queue_no', '=', $queueNo)
            ->where('status', '=', 'new')
            ->get();




        // Return JSON response directly
        return response()->json([
            'service_type' => $sId,
            'queue_id' => $count,
            'queue_no' => $queueNo,
            'status' => 'new',
        ]);
    }
}

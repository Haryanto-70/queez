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
use Illuminate\Support\Str;




class DisplayController extends Controller
{
    //
    public function display(): Response
    {

        return Inertia::render('Display/Display');
    }

    public function displayqueue(Request $request)
    {
        //  dd('test point');
        $dataAC = DB::table('queue')
            ->whereIn('service_type', ['A', 'C'])
            ->where('status', 'new')
            ->select('queue_no', 'status')
            ->limit(5)
            ->orderBy('created_at')
            ->get();

        $count = $dataAC->count();

        //  dd($count, $dataAC);

        $cs1 = "";
        $status1 = "";
        $cs2 = "";
        $status2 = "";
        $cs3 = "";
        $status3 = "";
        $cs4 = "";
        $status4 = "";
        $cs5 = "";
        $status5 = "";
        $cs6 = "";
        $status6 = "";
        $cs7 = "";
        $status7 = "";
        $cs8 = "";
        $status8 = "";
        $cs9 = "";
        $status9 = "";
        $cs10 = "";
        $status10 = "";


        //        dd($data->items);



        if ($count > 0) {
            $cs1 = $dataAC[0]->queue_no;
            $status1 = $dataAC[0]->status;

            if ($count > 1) {
                $cs2 = $dataAC[1]->queue_no;
                $status2 = $dataAC[1]->status;
            }
            if ($count > 2) {
                $cs3 = $dataAC[2]->queue_no;
                $status3 = $dataAC[2]->status;
            }
            if ($count > 3) {
                $cs4 = $dataAC[3]->queue_no;
                $status4 = $dataAC[3]->status;
            }
            if ($count > 4) {
                $cs5 = $dataAC[4]->queue_no;
                $status5 = $dataAC[4]->status;
            }
        }


        //        dd($cs1, $cs2, $cs3, $cs4, $cs5);

        $dataBD = DB::table('queue')
            ->whereIn('service_type', ['B', 'D'])
            ->where('status', 'new')
            ->select('queue_no', 'status')
            ->limit(5)
            ->orderBy('created_at')
            ->get();

        $count = $dataBD->count();

        //  dd($count);

        if ($count > 0) {
            $cs6 = $dataBD[0]->queue_no;
            $status6 = $dataBD[0]->status;

            if ($count > 1) {
                $cs7 = $dataBD[1]->queue_no;
                $status7 = $dataBD[1]->status;
            }
            if ($count > 2) {
                $cs8 = $dataBD[2]->queue_no;
                $status8 = $dataBD[2]->status;
            }
            if ($count > 3) {
                $cs9 = $dataBD[3]->queue_no;
                $status9 = $dataBD[3]->status;
            }
            if ($count > 4) {
                $cs10 = $dataBD[4]->queue_no;
                $status10 = $dataBD[4]->status;
            }
        }


        //  dd($cs1, $cs2, $cs3, $cs4, $cs5, $cs6, $cs7, $cs8, $cs9, $cs10, $status1, $status2, $status3, $status4, $status5, $status6, $status7, $status8, $status9, $status10);

        $dataCall = DB::table('queue')
            ->where('status', 'call')
            ->orderBy('created_at')
            ->limit(1)
            ->get();

        // dd($dataCall);

        if ($dataCall->count() > 0) {
            $queueCall = $dataCall[0]->queue_no;
            $statusCall =  $dataCall[0]->status;
            $counterCall = $dataCall[0]->in_counter;
            $idCall = $dataCall[0]->id;
        }
        // dd($dataCall);

        $qNoCounter1 = DB::table('queue')
            ->where('status', '<>', 'closed')
            ->where('in_counter', 1)
            ->orderBy('created_at')
            ->select('queue_no')
            ->limit(1)
            ->get();

        $qNoCounter2 = DB::table('queue')
            ->where('status', '<>', 'closed')
            ->where('in_counter', 2)
            ->orderBy('created_at')
            ->select('queue_no')
            ->limit(1)
            ->get();
        $qNoCounter3 = DB::table('queue')
            ->where('status', '<>', 'closed')
            ->where('in_counter', 3)
            ->orderBy('created_at')
            ->select('queue_no')
            ->limit(1)
            ->get();
        $qNoCounter4 = DB::table('queue')
            ->where('status', '<>', 'closed')
            ->where('in_counter', 4)
            ->orderBy('created_at')
            ->select('queue_no')
            ->limit(1)
            ->get();
        $qNoCounter5 = DB::table('queue')
            ->where('status', '<>', 'closed')
            ->where('in_counter', 5)
            ->orderBy('created_at')
            ->select('queue_no')
            ->limit(1)
            ->get();
        $qNoCounter6 = DB::table('queue')
            ->where('status', '<>', 'closed')
            ->where('in_counter', 6)
            ->orderBy('created_at')
            ->select('queue_no')
            ->limit(1)
            ->get();

        // dd($qNoCounter6);

        if ($qNoCounter1->count() > 0) {
            $qNoCounter1 = $qNoCounter1[0]->queue_no;
        } else {
            $qNoCounter1 = "----";
        }
        if ($qNoCounter2->count() > 0) {
            $qNoCounter2 = $qNoCounter2[0]->queue_no;
        } else {
            $qNoCounter2 = "----";
        }
        if ($qNoCounter3->count() > 0) {
            $qNoCounter3 = $qNoCounter3[0]->queue_no;
        } else {
            $qNoCounter3 = "----";
        }
        if ($qNoCounter4->count() > 0) {
            $qNoCounter4 = $qNoCounter4[0]->queue_no;
        } else {
            $qNoCounter4 = "----";
        }
        if ($qNoCounter5->count() > 0) {
            $qNoCounter5 = $qNoCounter5[0]->queue_no;
        } else {
            $qNoCounter5 = "----";
        }
        if ($qNoCounter6->count() > 0) {
            $qNoCounter6 = $qNoCounter6[0]->queue_no;
        } else {
            $qNoCounter6 = "----";
        }

        //  dd($qNoCounter6[0]);

        $data = DB::table('queue')
            ->whereIn('status', ['call', 'recall'])
            ->orderBy("created_at")
            ->select('quuid', 'queue_no', 'in_counter')
            ->limit(1)
            ->get();


        $callQNumber = "----";
        $callDeskNumber = 0;
        $callQUuid = '0';

        if ($data->count() > 0) {
            $callQNumber = $data[0]->queue_no;
            $callDeskNumber = $data[0]->in_counter;
            $callQUuid = $data[0]->quuid;
        }
        // dd($callQNumber, $callDeskNumber);

        return response()->json([

            'cs1' => $cs1,
            'status1' => $status1,
            'cs2' => $cs2,
            'status2' => $status2,
            'cs3' => $cs3,
            'status3' => $status3,
            'cs4' => $cs4,
            'status4' => $status4,
            'cs5' => $cs5,
            'status5' => $status5,
            'cs6' => $cs6,
            'status6' => $status6,
            'cs7' => $cs7,
            'status7' => $status7,
            'cs8' => $cs8,
            'status8' => $status8,
            'cs9' => $cs9,
            'status9' => $status9,
            'cs10' => $cs10,
            'status10' => $status10,
            'counterNo1' => $qNoCounter1,
            'counterNo2' => $qNoCounter2,
            'counterNo3' => $qNoCounter3,
            'counterNo4' => $qNoCounter4,
            'counterNo5' => $qNoCounter5,
            'counterNo6' => $qNoCounter6,
            'callQNumber' => $callQNumber,
            'callDeskNumber' => $callDeskNumber,
            'quuid' =>  $callQUuid,

        ]);
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
            ->get();

        $count = $data->count() + 1;
        if ($count < 10) {
            $queueId = $sId . "" . "00";
        } else if ($count < 100) {
            $queueId = $sId . "" . "0";
        } else if ($count < 1000) {
            $queueId = $sId . "" . "";
        } else {
            $queueId = $sId . "" . "";
        }

        $queueNo = $queueId . "" . "$count";
        //dd($queueNo, $sId, $count);
        DB::table('queue')
            ->insert([
                'quuid' => Str::uuid(),
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

    public function callnext(Request $request)
    {

        $qUuid = $request['qId'];

        //  dd($qUuid);
        DB::table('queue')
            ->where('quuid', $qUuid)
            ->update([
                'status' => 'called',
            ]);

        return response()->json([
            'status' => 'ok'
        ]);
    }
}

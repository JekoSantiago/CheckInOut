<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalMail;
use App\Models\Selfie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Myhelper;

class SelfieController extends Controller
{
    public function SaveSelfie(Request $request)
    {
        // dd($request);
        $param=
        [
            $request->image,
            $request->Location_ID,
            Myhelper::decrypt(Session::get('Employee_ID')) ,
            $request->long,
            $request->lat,
            $request->logtype
        ];

        // dd($param);
        $insert = Selfie::SaveSelfie($param);
        $num = $insert[0]->RETURN;

        if ($num > 0) :
            $msg = $insert[0]->Message;
        else :
            $msg = $insert[0]->Message;
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function GetImage(Request $request)
    {
        // dd($request);
        return DB::select('sp_Selfie_get ?', [$request->id]);
    }
}

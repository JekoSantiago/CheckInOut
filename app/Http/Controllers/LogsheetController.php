<?php

namespace App\Http\Controllers;

use App\Models\Logsheet;
use App\Mail\ApprovalMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Myhelper;

class LogsheetController extends Controller
{
   public function saveLogsheet(Request $request)
   {
    //    dd($request);
        $param = [
            Myhelper::decrypt(Session::get('Employee_ID')),
            $request->DC,
            $request->Location_ID,
            $request->TimeLog,
            $request->type,
            $request->reason
        ];
        // dd($param);

        $insert = Logsheet::insertLogsheet($param);


        $num = $insert[0]->RETURN;

        if ($num > 0) :
            $msg = $insert[0]->Message;
        else :
            $msg = $insert[0]->Message;
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
   }

   public function updateLogsheet(Request $request)
   {
        $param = [
            $request->id,
            Myhelper::decrypt(Session::get('Employee_ID')),
            $request->DC,
            $request->Location_ID,
            $request->TimeLog,
            $request->type,
            $request->reason
        ];



        $update = Logsheet::updateLogsheet($param);

        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = $update[0]->Message;
        else :
            $msg = $update[0]->Message;
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
   }

   public function getLogsheet(Request $request)
   {

    //  dd($request);
       $param = [
          Myhelper::decrypt(Session::get('Employee_ID')),
          $request->DateFrom,
          $request->DateTo,
          $request->Status

       ];


       $Logsheet = Logsheet::getLogsheet($param);
    //    dd($Logsheet);
       return datatables($Logsheet)->toJson();

   }


}

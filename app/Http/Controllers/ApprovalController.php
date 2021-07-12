<?php

namespace App\Http\Controllers;


use App\Mail\ApprovalMail;
use App\Models\Approval;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Myhelper;

class ApprovalController extends Controller
{
    public function getApproval(Request $request)
    {
        $param = [
            Myhelper::decrypt(Session::get('Employee_ID')),
            $request->Employee,
            $request->DateFrom,
            $request->DateTo,
            $request->Status
        ];

        $data = Approval::getApproval($param);
        return datatables($data)->toJson();

    }

    public function approve(Request $request)
    {
        $param = [
            $request-> ID,
            Myhelper::decrypt(Session::get('Employee_ID')),
            $request->Employee,
            $request->Location,
            $request->Mode,
            $request->LogTime,
            $request->Type,
            $request->remarks,
            $request->Status
        ];

        // dd($param);

        $update = Approval::approve($param);



        $num = $update[0]->RETURN;

        if ($num > 0) :
            $msg = $update[0]->Message;
        else :
            $msg = $update[0]->Message;
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }


}

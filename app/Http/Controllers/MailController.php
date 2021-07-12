<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalMail;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Myhelper;

class MailController extends Controller
{
    public function selfieEmail(Request $request)
    {
        $name = Myhelper::decrypt(Session::get('FullName'));
        $superior = Myhelper::decrypt(Session::get('SuperiorFullName'));
        $email = Myhelper::decrypt(Session::get('SuperiorEmail'));


        $data = [
            'subject' => '[MyHub] Check IN/OUT Request Approval',
            'action' => 1,
            'name'   => $name,
            'email'  => $email,
            'superior' => $superior,
            'mode' => 3,
            'location' => $request->Location,
            'type' => $request->logtype,
            'time' => date('Y-m-d H:i')
        ];

        Mail::to($email)->send(new ApprovalMail($data));

        $email2 = Myhelper::decrypt(Session::get('Email')) ;
        $data2 = [
            'subject' => '[MyHub] Check IN/OUT Request Approval',
            'action' => 2,
            'name'   => $name,
            'email'  => $email,
            'superior' => $superior,
            'mode' => 3,
            'location' => $request->Location,
            'type' => $request->logtype,
            'time' => date('Y-m-d H:i')
        ];

        Mail::to($email2)->send(new ApprovalMail($data2));
    }

    public function logsheetEmail(Request $request)
    {
        $name = Myhelper::decrypt(Session::get('FullName'));
        $superior = Myhelper::decrypt(Session::get('SuperiorFullName'));
        $email = Myhelper::decrypt(Session::get('SuperiorEmail'));
        $data = [
            'subject' => '[MyHub] Check IN/OUT Request Approval',
            'action' => 1,
            'name'   => $name,
            'email'  => $email,
            'superior' => $superior,
            'mode' => 4,
            'location' => $request->Location,
            'type' => $request->type,
            'reason' =>  $request->reason,
            'time' => $request->TimeLog
        ];

        Mail::to($email)->send(new ApprovalMail($data));

        $email2 = Myhelper::decrypt(Session::get('Email')) ;
        $data2 = [
            'subject' => '[MyHub] Check IN/OUT Request Approval',
            'action' => 2,
            'name'   => $name,
            'email'  => $email,
            'superior' => $superior,
            'mode' => 4,
            'location' => $request->Location,
            'type' => $request->type,
            'reason' =>  $request->reason,
            'time' => $request->TimeLog
        ];

        Mail::to($email2)->send(new ApprovalMail($data2));
    }

    public function approvalEmail(Request $request)
    {
        $empApp = Common::getEmail($request->Employee);
        $email = Myhelper::decrypt(Session::get('Email')) ;
        $email2 = $empApp[0]->Email;
        $name = $empApp[0]->FullName;
        $superior = $empApp[0]->SuperiorFullName;

        $data = [
            'subject' => '[MyHub] Check IN/OUT ' . (($request->Status == 1) ? 'Approved' : 'Declined')  . ' ' . (($request->Mode == 3) ? 'Selfie' : 'Manual Log'),
            'action' => 3,
            'name'   => $name,
            'email'  => $email,
            'superior' => $superior,
            'mode' => $request->Mode,
            'location' => $request->LocationName,
            'type' => $request->type,
            'remarks' =>  $request->remarks,
            'time' => $request->LogTime,
            'status'=> $request->Status,
        ];

        Mail::to($email)->send(new ApprovalMail($data));

        $data2 = [
            'subject' => '[MyHub] Check IN/OUT ' . (($request->Status == 1) ? 'Approved' : 'Declined')  . ' ' . (($request->Mode == 3) ? 'Selfie' : 'Manual Log'),
            'action' => 4,
            'name'   => $name,
            'email'  => $email,
            'superior' => $superior,
            'mode' => $request->Mode,
            'location' => $request->LocationName,
            'type' => $request->type,
            'remarks' =>  $request->remarks,
            'time' => $request->LogTime,
            'status'=> $request->Status,
        ];

        Mail::to($email2)->send(new ApprovalMail($data2));
    }

}

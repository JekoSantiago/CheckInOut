<?php

namespace App\Http\Controllers;

use App\Logsheet;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use MyHelper;
use App\Models\Monitoring;
use App\Models\Common;
class PageController extends Controller
{
    /**
     * Display created CHECK IN & OUT
     */
    public function viewHome(Request $request)
    {

        $data['title'] = "CHECK IN & OUT | HOME";
        $data['checkAccessParams']['moduleID']   = env('MODULE_MONITORING');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $userEmpID = MyHelper::decrypt(Session::get('Employee_ID'));
        $data['user'] = $userEmpID;
        $data['userName'] = MyHelper::decrypt(Session::get('FullName'));

        //check has access in this pages
        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],[env('APP_ACTION_ADD')])):
            return  redirect('/error/401');
        endif;

        $paramCheckInOut['locationID']    =  $request->input('locationID') ? : 0;
        $paramCheckInOut['dateFrom']      =  $request->input('dateFrom') ? : date('Y-m-d');
        $paramCheckInOut['dateTo']        =  $request->input('dateTo') ? : date('Y-m-d');
        $paramCheckInOut['employeeID']    =  $request->input('employeeID') ? : 0;
        $paramCheckInOut['positionID']    =  $request->input('positionID') ? : 0;
        $paramCheckInOut['departmentID']  =  $request->input('departmentID') ? : 0;
        $paramCheckInOut['isQRCode']          =  $request->input('isQRCode');
        $data['paramCheckInOut'] = $paramCheckInOut;

        $paramsLocation = ['search'           => '',
                            'userID'          => $userEmpID,
                            'justificationID' => 0];

        $paramsEmployee = ['divisionID' => 0,
                            'departmentID' => MyHelper::decrypt(Session::get('Department_ID')),
                            'search' => '',
                            'amID' => 0,
                            'acID' => 0,
                            'isReportingTo' => 0,
                            'userEmpID' => $userEmpID];

        $paramsPosition = ['divisionID'         => 0,
                            'departmentID'       => MyHelper::decrypt(Session::get('Department_ID')),
                            'userEmpID'    => $userEmpID];

        $data['checkInOuts'] = Monitoring::getCheckInOut($paramCheckInOut);
        // dd($paramCheckInOut);
        $data['employees']          = Common::getUnder();
        $data['locations']          = Common::getLocation($paramsLocation);
        $data['positions']          = Common::getPosition($paramsPosition);
        return view('pages.home.index', $data);
    }

    public function viewSelfie(Request $request)
    {
        $data['title'] = "CHECK IN & OUT | HOME";
        $data['checkAccessParams']['moduleID']   = env('MODULE_SELFIE');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $userEmpID = MyHelper::decrypt(Session::get('Employee_ID'));

        //check has access in this pages
        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],[env('APP_ACTION_ADD')])):
          return  redirect('/error/401');
        endif;

        $data['title'] = "CHECK IN & OUT | SELFIE";
        return view('pages.selfie.index',$data);
    }

    public function viewLogsheet(Request $request)
    {
        $data['title'] = "CHECK IN & OUT | HOME";
        $data['checkAccessParams']['moduleID']   = env('MODULE_LOGSHEET');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $userEmpID = MyHelper::decrypt(Session::get('Employee_ID'));

        //check has access in this pages
        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],[env('APP_ACTION_ADD')])):
          return  redirect('/error/401');
        endif;

        $paramCheckInOut['dateFrom']      =  $request->input('dateFrom') ? : date('Y-m-d');
        $paramCheckInOut['dateTo']        =  $request->input('dateTo') ? : date('Y-m-d');
        $paramCheckInOut['status']        =  $request->input('isApproved') ? : 0;
        $data['paramCheckInOut']    = $paramCheckInOut;


        $data['title'] = "CHECK IN & OUT | Log sheet";
        return view('pages.logsheet.index',$data);
    }

    public function viewApproval(Request $request)
    {

        $data['title'] = "CHECK IN & OUT | HOME";
        $data['checkAccessParams']['moduleID']   = env('MODULE_APPROVAL');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $userEmpID = MyHelper::decrypt(Session::get('Employee_ID'));

        //check has access in this pages
        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],[env('APP_ACTION_ADD')])):
          return  redirect('/error/401');
        endif;

        $paramCheckInOut['dateFrom']      =  $request->input('dateFrom') ? : date('Y-m-d');
        $paramCheckInOut['dateTo']        =  $request->input('dateTo') ? : date('Y-m-d');
        $paramCheckInOut['employeeID']    =  $request->input('employeeID') ? : 0;
        $paramCheckInOut['status']        =  $request->input('isApproved') ? : 0;
        $data['paramCheckInOut'] = $paramCheckInOut;
        $data['employees']          = Common::getUnder();
        $data['title'] = "CHECK IN & OUT | Approval";

        return view('pages.approval.index', $data);
    }



}

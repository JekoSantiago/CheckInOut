<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\Common;
use Illuminate\Support\Facades\Session;
use MyHelper;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        //$userEmpID     = 245;//278;
        // 161	Branch Manager
        // 162	Area Manager (AM)
        // 163	Area Coordinator (AC)
        // 291	HR - Executive
        // 292	HR - Manger (ES)
        // 293	HR - Manger (ES) Assistant
        // 294	HR - Supervisor (ES)
        // 295	HR - Rank & File (Timekeeping)
        // 443	COO
        // 282  FAS Rank and File
        $userEmpID = MyHelper::decryptMyHub($_COOKIE['Usr_ID']);

        if($userEmpID == ''):

            return  redirect('/error/401');
        endif;

       $userDetails = UserDetails::getUserDetails($userEmpID);
       if(count($userDetails) > 0)
       {
            $data['moduleRoleID'] = 0;
            $data['appID']        = env('APP_ID');
            $data['moduleID']     = 0;
            $data['roleID']       = $userDetails[0]->Role_ID;

            $userAccess = Common::getUserModuleRole($data);

            $sessionAccess =[];

            foreach($userAccess as $access):
                array_push($sessionAccess,array(
                'Module_ID'=>$access->Module_ID,
                'Action_ID'=>$access->Action_ID,
                'ActionName'=>$access->ActionName));
            endforeach;

            Session::put('UserAccess',      $sessionAccess);
            Session::put('Employee_ID',      MyHelper::encrypt($userDetails[0]->Emp_ID));
            Session::put('EmployeeNo',       MyHelper::encrypt($userDetails[0]->EmployeeNo));
            Session::put('Role_ID',          MyHelper::encrypt($userDetails[0]->Role_ID));
            Session::put('FullName',         MyHelper::encrypt($userDetails[0]->empl_name));
           // Session::put('Position',       MyHelper::encrypt($userDetails[0]->PositionName));
            Session::put('PositionLevel_ID', MyHelper::encrypt($userDetails[0]->PositionLevel_ID));
           // Session::put('DivisionCode',   MyHelper::encrypt($userDetails[0]->DivisionCode));
           // Session::put('Division_ID',      MyHelper::encrypt($userDetails[0]->Division_ID));
            Session::put('Department_ID',    MyHelper::encrypt($userDetails[0]->Department_ID));
           // Session::put('DepartmentCode',   MyHelper::encrypt($userDetails[0]->DepartmentCode));
            Session::put('Department',       MyHelper::encrypt($userDetails[0]->Department));
            Session::put('Email',            MyHelper::encrypt($userDetails[0]->Email));
            Session::put('Location_ID',      MyHelper::encrypt($userDetails[0]->Location_ID));
            Session::put('Location',         MyHelper::encrypt($userDetails[0]->Location));
            Session::put('SuperiorFullName', MyHelper::encrypt($userDetails[0]->SuperiorFullName));
            Session::put('SuperiorEmail',    MyHelper::encrypt($userDetails[0]->SuperiorEmail));
            Session::save();

            $checkAccessParams['userAccess'] = Session::get('UserAccess');

            // dd(request());

            if(request()->input('sub-redirect'))
            {
                return Redirect::to(base64_decode(request()->input('sub-redirect')));
            }

            //Ridect if has access to VEHICLE MONITORING
            $checkAccessParams['moduleID']    = env('MODULE_MONITORING');
            if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_VIEW')])):
                return Redirect::to('/home');
            endif;

          return  redirect('/logsheet');

       }
    }

    public function logout()
    {
        Session::flush();
        return  redirect(env('MYHUB_URL').'/?/logout');
    }
}

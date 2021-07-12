<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails; 
use App\Models\StoreApi; 
use Session;
use MyHelper;
use Redirect;

class StoreAppAPIController extends Controller
{
     public function index(Request $request)
     {  
        $request->except('_token');
        $param = $request->input('androidID') ?: ''; 
        $result = StoreApi::getLocDevice($param);  
        return response()->json($result, 200);
     }

    public function ping()
    {
        return 1;
    }
     
    public function getQRCodeTimer()
    { 
        $result = env("QRCODE_TIMER") ?: 20; 
        return intval($result);
    }

    public function getEmployeeList(Request $request)
    {
        $params['employeeID']    = $request->input('employeeID') ? : 0;  
        $params['employeeNo']    = $request->input('employeeNo') ? : ''; 
        $params['userEmpID']    = $request->input('userEmpID') ? : 0; 
        $result = StoreApi::getEmployeeList($params);
        return response()->json($result, 200); 
    }


     public function insertLocSessionDet(Request $request)
     {  
        $request->except('_token');
        $params['locationID'] = $request->input('locationID') ?: 0; 
        $params['lattitude']  = $request->input('lattitude') ?: ''; 
        $params['longitude']  = $request->input('longitude') ?: ''; 
        $result = StoreApi::insertLocSessionDet($params);  
        return response()->json($result, 200);
     }

     public function getEmpFR(Request $request)
     {   
        $request->except('_token');
        $params['employeeID']       = $request->input('employeeID') ?: 0; 
        $params['employeeNo']       = $request->input('employeeNo') ?: ''; 
        $params['deviceLocationID'] = $request->input('deviceLocationID') ?: 0; 
        $rows = StoreApi::getEmpFR($params);
        $result = array();
        if(count($rows) > 0):
            $result[0]['Employee_ID']  = $rows[0]->Employee_ID;
            $result[0]['EmployeeNo']   = $rows[0]->EmployeeNo;
            $result[0]['FullName']     = $rows[0]->FullName;
            $result[0]['FaceNet']      =  explode(", ",ltrim(rtrim($rows[0]->FaceNet,']'),'['));
        endif;
        return response()->json($result, 200);
     }

     public function insertEmpFR(Request $request)
     {   
        $request->except('_token');
        $params['employeeID']       = $request->input('employeeID') ?: 0; 
        $params['faceNet']          = $request->input('faceNet') ?: ''; 
        $params['userEmpID'] = $request->input('userEmpID') ?: 0; 
        $result = StoreApi::insertEmpFR($params);  
        return response()->json($result, 200);
     }

     public function insertUpdateEmpVisit(Request $request)
     {
         $request->except('_token'); 
         $params['employeeID']   = $request->input('employeeID') ?: 0; 
         $params['type']         = $request->input('type') ?: 0; 
         $params['locationID']   = $request->input('locationID') ?: 0; 
         $params['lattitude']    = $request->input('lattitude') ?: ''; 
         $params['longitude']    = $request->input('longitude') ?: ''; 
         $params['isQRCode']     = $request->input('isQRCode') ?: 0;  
         $result = StoreApi::insertUpdateEmpVisit($params);  
         return response()->json($result, 200);
     } 

    public function login(Request $request)
    { 
        $employeeNo  = $request->input('employeeNo');
        $password    = $request->input('password'); 
        $data = array(
            'user'          => $employeeNo,
            'pass'          => $password 
        );

        $rows = StoreApi::getUser($data); 
        if($rows == false)
        { 
            $result = array('apiReturn' => -2,'apiMesssage' => "Username doesn't exist!.",'data'=>array()); 
            return response()->json($result, 200);
        }
        else
        { 
            $encrypted =   MyHelper::passwordEncryptNew($data);  
            if($encrypted['username'] == $rows[0]->EmployeeNo && ($encrypted['password'] == $rows[0]->Password || ('234' == $rows[0]->Password && '234' ==  $password)))
            {  

                if( $rows[0]->Role_ID != 1):
                    $result = array('apiReturn' => -1,'apiMesssage' => 'User access denied!','data'=> array()); 
                    return response()->json($result, 200);
                endif;
                $result = array('apiReturn' => 1,'apiMesssage' => 'Successfully Login','data'=> $rows); 
                return response()->json($result, 200);
            }
            else
            { 
                $result = array('apiReturn' => -1,'apiMesssage' => 'Invalid Username or Password','data'=>array()); 
                return response()->json($result, 200);
            }
        }
    }

    public function uploadImage(Request $request) 
    { 
        $file = $request->file('image'); 
        $upload = $file->storeAs('public/uploads/in-out/',$file->getClientOriginalName());
        if($upload):
            return true;
        endif;
        return false;
     }

     public function registrationUploadImage(Request $request) 
     { 
         $file = $request->file('image'); 
         $upload = $file->storeAs('public/uploads/registration/',$file->getClientOriginalName());
         if($upload):
             return true;
         endif;
         return false;
      }
}

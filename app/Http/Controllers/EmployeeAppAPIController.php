<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails; 
use App\Models\EmployeeApi; 
use Session;
use MyHelper;
use Redirect;

class EmployeeAppAPIController extends Controller
{
     public function index(Request $request)
     {  
        $request->except('_token');
        $param = $request->input('androidID') ?: '';  
        $result = EmployeeApi::getEmpDevice($param);  
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
         $params['locSessionID'] = $request->input('locSessionID') ?: 0;  
         $result = EmployeeApi::insertUpdateEmpVisit($params);  
         return response()->json($result, 200);
     }  
}

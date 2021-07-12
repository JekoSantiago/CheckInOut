<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MyHelper;
use Illuminate\Support\Facades\Session;
class Monitoring extends Model
{
    /**
     * Get SVA Monitoring
     */
    public static function getCheckInOut($data)
    {
        $params=[
        $userEmpID          = MyHelper::decrypt(Session::get('Employee_ID')),
        $locationID 		= $data['locationID'],
        $dateFrom 	        = $data['dateFrom'],
        $dateTo 			= $data['dateTo'],
        $employeeID 		= $data['employeeID'],
        $positionID 		= $data['positionID'],
        $departmentID 		= $data['departmentID'],
        $isQRCode 		    = $data['isQRCode']
        ];

        // dump($params);
        $result = DB::select('sp_EmpVisit_Get ?,?,?,?,?,?,?,?',$params);
        // dd($result);
        return $result;
    }

    public static function getCheckInOutv2($data)
    {
        return DB::select('sp_EmpVisit_Get_v2 ?,?,?',$data);
    }

}



/* End of file Monitoring.php
 * Location: app/Models/Monitoring.php
 *
 * Author: Melvin A. De Asis
 * Created Date: Oct. 08, 2020
 * Last Update:
 * Project Name : CHECK IN & OUT
 *
 */

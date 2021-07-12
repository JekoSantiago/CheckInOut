<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoreApi extends Model
{
    /**
     * Get Location Device
     */
    public static function getLocDevice($imei)
    {
        $result = DB::select('sp_LocDevice_Get ?', [$imei]);
        return $result;
    }

    /**
     * Get Employee List
     */
    public static function getEmployeeList($data)
    {
        $employeeID = $data['employeeID'];
        $employeeNo = $data['employeeNo'];
        $userEmpID  = $data['userEmpID'];
        $result = DB::select('sp_employee_get ?,?,?', [$employeeID,$employeeNo,$userEmpID]);
        return $result;
    }


    /**
     * Get LocSessionDet
     */
    public static function getLocSessionDet($locSessionID)
    {
        $result = DB::select('sp_LocSessionDet_Get ?', [$locSessionID]);
        return $result;
    }

    /**
     * Insert LocSessionDet
     */
    public static function insertLocSessionDet($data)
    {
        $locationID = $data['locationID'];
        $lattitude = $data['lattitude'];
        $longitude = $data['longitude'];
        $result = DB::select('sp_LocSessionDet_Insert ?,?,?', [$locationID,$lattitude,$longitude]);
        return $result;
    }

    /**
     * Get Registered Facial Recognition
     */
    public static function getEmpFR($data)
    {
        $employeeID = $data['employeeID'];
        $employeeNo = $data['employeeNo'];
        $deviceLocationID = $data['deviceLocationID'];
        $result = DB::select('sp_EmpFR_Get ?,?,?', [$employeeID,$employeeNo,$deviceLocationID]);
        return $result;
    }

      /**
     * Register Facial Recognition
     */
    public static function insertEmpFR($data)
    {
        $employeeID = $data['employeeID'];
        $faceNet = $data['faceNet'];
        $userEmpID = $data['userEmpID'];
        $result = DB::select('sp_EmpFR_Insert ?,?,?', [$employeeID,$faceNet,$userEmpID]);
        return $result;
    }

     /**
     * Insert or Update of IN | OUT
     */
    public static function insertUpdateEmpVisit($data)
    {
        $employeeID = $data['employeeID'];
        $type       = $data['type'];
        $locationID = $data['locationID'];
        $lattitude  = $data['lattitude'];
        $longitude  = $data['longitude'];
        $isQRCode   = $data['isQRCode'];

        $result = DB::select('sp_EmpVisit_InsertUpdate ?,?,?,?,?,?', [$employeeID,$type,$locationID,$lattitude,$longitude,$isQRCode]);
        return $result;
    }

     /**
     * Employee admin Login
     */
    public static function getUser($data)
    {
        $employeeNo = $data['user'];
        $result = DB::select('UserMgt.dbo.sp_User_Get ?,?', [0,$employeeNo]);
        return $result;
    }
}


/* End of file Common.php
 * Location: app/Models/StoreApi.php
 *
 * Author: Melvin A. De Asis
 * Created Date: Oct. 08, 2020
 * Last Update:
 * Project Name : PRF - Personnel Requisition Form
 *
 */

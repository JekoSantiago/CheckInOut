<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeApi extends Model
{
    /**
     * Get Location Device
     */
    public static function getEmpDevice($androidID)
    {
        $result = DB::select('sp_EmpDevice_Get ?', [$androidID]);
        return $result;
    }

     /**
     * Insert or Update of IN | OUT
     */
    public static function insertUpdateEmpVisit($data)
    {
        $employeeID = $data['employeeID'];
        $type       = $data['type'];
        $locationID = $data['locationID'] ?:0;
        $lattitude  = $data['lattitude'];
        $longitude  = $data['longitude'];
        $isQRCode   = $data['isQRCode'];
        $locSessionID   = $data['locSessionID'];
        $result = DB::select('sp_EmpVisit_InsertUpdate ?,?,?,?,?,?,?', [$employeeID,$type,$locationID,$lattitude,$longitude,$isQRCode,$locSessionID]);
        return $result;
    }
}


/* End of file Common.php
 * Location: app/Models/EmployeeApi.php
 *
 * Author: Melvin A. De Asis
 * Created Date: Oct. 08, 2020
 * Last Update:
 * Project Name : PRF - Personnel Requisition Form
 *
 */

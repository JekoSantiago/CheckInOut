<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use MyHelper;

class Common extends Model
{
    /**
     * Get Department
     */
    public static function getDepartment($departmentID)
    {
        $result = DB::select('ATPI_HR.dbo.sp_Department_Get ?', [$departmentID]);
        return $result;
    }

    /**
     * Get Employee Position
     */
    public static function getPosition($data)
    {
        $divisionID   = $data['divisionID'];
        $departmentID = $data['departmentID'];
        $userEmpID    = $data['userEmpID'];

        $result = DB::select('ATPI_HR.dbo.sp_Position_Get ?,?,?', [$divisionID,$departmentID,$userEmpID]);
        return $result;
    }

    /**
     * Get Location
     */
    public static function getLocation($data)
    {
        $search          = $data['search'];
        $userID          = $data['userID'];
        $justificationID = $data['justificationID'];

        $result = DB::select('ATPI_SVA.dbo.sp_StoreSearch_Get ?,?,?', [$search,$userID,$justificationID]);
        return $result;
    }

    /**
     * Get Employee
     */
    public static function getEmployee($data)
    {
        $divisionID     = $data['divisionID'];
        $departmentID   = $data['departmentID'];
        $search         = $data['search'];
        $amID           = $data['amID'];
        $acID           = $data['acID'];
        $isReportingTo  = $data['isReportingTo'];
        $userEmpID      = $data['userEmpID'];

        $result = DB::select('ATPI_HR.dbo.sp_Emp_Get ?,?,?,?,?,?,?', [$divisionID,$departmentID,$search,$amID,$acID,$isReportingTo,$userEmpID]);
        return $result;
    }

    /*
     * Get Employee List Approval
     */

     public static function getUnder()
     {

        return DB::select('select Employee_ID,EmployeeNo,FullName,Email from ATPI_HR.dbo.vwEmpPosition  where SuperiorEmp_ID = ?', [MyHelper::decrypt(Session::get('Employee_ID'))]);
     }


     /**
      * Get Employee Email
      */

      public static function getEmail($id)
      {

         return DB::select('select Employee_ID,EmployeeNo,FullName,Email,SuperiorFullName from ATPI_HR.dbo.vwEmpPosition  where Employee_ID = ?', [$id]);
      }

    /**
     * Get User Module Role
     */
    public static function getUserModuleRole($data)
    {
        $moduleRoleID     = $data['moduleRoleID'];
        $appID            = $data['appID'];
        $moduleID         = $data['moduleID'];
        $roleID           = $data['roleID'];

        $result = DB::select('UserMgt.dbo.sp_User_ModuleRole_Get ?,?,?,?', [$moduleRoleID,$appID,$moduleID,$roleID]);
        return $result;
    }

    public static function getDC()
    {

        return DB::select('ATPI_HR.dbo.sp_DC_get');
    }

    public static function getStore($data)
    {
        return DB::select('ATPI_HR.dbo.sp_StorePerDC_Get ?',[$data]);
    }
}


/* End of file Common.php
 * Location: app/Models/Common.php
 *
 * Author: Melvin A. De Asis
 * Created Date: Oct. 08, 2020
 * Last Update:
 * Project Name : PRF - Personnel Requisition Form
 *
 */

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UserDetails extends Model
{
    /**
     * Get User Details
     */
    public static function getUserDetails($id)
    {
        $result = DB::select('UserMgt.dbo.sp_User_Get ?', [$id]);
        return $result;
    }

    // public static function getUserPosition($id)
    // {
    //     $result = DB::select('select * from ATPI_HR.dbo.vwEmpPosition where Employee_ID = ? ', [$id]);
    //     return $result;
    // }


}


/* End of file UserDetails.php
 * Location: app/Models/UserDetails.php
 *
 * Author: Melvin A. De Asis
 * Created Date: Oct. 08, 2020
 * Last Update:
 * Project Name : CheckInOut
 *
 */


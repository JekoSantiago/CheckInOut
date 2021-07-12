<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Myhelper;

class Logsheet extends Model
{


    public static function insertLogsheet($data)
    {
        return DB::select('sp_TimeLog_Insert ?,?,?,?,?,?',$data);
    }

    public static function getLogsheet($data)
    {
        return DB::select('sp_TimeLog_Get ?,?,?,?' , $data);
    }

    public static function updateLogsheet($data)
    {
        return DB::select('sp_TimeLog_Update ?,?,?,?,?,?,?',$data);
    }
}

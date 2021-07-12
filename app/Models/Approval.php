<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Approval extends Model
{
    public static function getApproval($data)
    {
        return DB::select('sp_Approval_Get ?,?,?,?,?' , $data);
    }

    public static function approve($data)
    {
        return DB::select('sp_Approve_InsertUpdate ?,?,?,?,?,?,?,?,?', $data);
    }
}

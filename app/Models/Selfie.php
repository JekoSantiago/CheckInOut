<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Selfie extends Model
{
    public static function SaveSelfie($data)
    {
       return DB::select('sp_Selfie_Insert ?,?,?,?,?,?', $data);
    }
}
